<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\IngredientsForRecipe;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImportRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:recipes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function getCategories(Spreadsheet $spreadsheet): array
    {
        $count = $spreadsheet->getSheetCount();
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $categoryName = $spreadsheet->getSheet($i)->getCell('F2')->getValue();
            $result[] = [
                'name' => $categoryName,
                'url' => Str::slug($categoryName)
            ];
        }
        return array_values(collect($result)->unique('url')->toArray());
    }

    private function getRecipes(Spreadsheet $spreadsheet): array
    {
        $count = $spreadsheet->getSheetCount();
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $row = [];
            $row['title'] = $sheet->getTitle();
            $row['image_url'] = $sheet->getCell('H2')->getValue();
            $row['url'] = $sheet->getCell('E2')->getValue();
            $row['category_id'] = Str::slug($sheet->getCell('F2')->getValue());
            $row['preparation_time'] = $sheet->getCell('I2')->getFormattedValue();
            $row['difficulty'] = $sheet->getCell('K2')->getValue();
            $row['difficulty'] = str_replace(
                ['łatwa', 'średnia', 'srednia'],
                ['łatwe','średnie', 'średnie'],
                $row['difficulty']
            );
            $row['cost'] = $sheet->getCell('L2')->getValue();
            $result[] = $row;
        }
        $categories = Category::all();
        array_walk($result, function (&$item) use ($categories) {
            $item['category_id'] = Arr::first($categories->filter(
                fn(Category $cat) => $cat->url === $item['category_id']
            )
            )?->id;
            return $item;
        });
        return $result;
    }

    public function getColumn(Worksheet $worksheet, string $column, string $key): array
    {
        $index = 2;
        $result = [];
        do {
            $cellValue = $worksheet->getCell($column . $index)->getValue();
            $index++;
            if (!$cellValue) {
                break;
            }
            $result[] = [$key => $cellValue];
        } while (true);
        return $result;
    }

    public function getIngredients(Spreadsheet $spreadsheet): array
    {
        $count = $spreadsheet->getSheetCount();
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $ingredients = $this->getColumn($sheet, 'A', 'name');
            $result = array_merge($result, $ingredients);
        }
        $result = collect($result)->unique();
        $ingredientsDb = Ingredient::query()->select(['name','recountable','base_weight'])->get();
        $data = [];
        $names = $ingredientsDb->pluck('name')->toArray();
        foreach ($result as $item) {
            if (in_array($item['name'], $names)) {
                continue;
            }
            $data[] = [
                'name' => $item['name'],
                'recountable' => 0,
                'base_weight' => 0
            ];
        }
        return $data;
    }

    public function getIngredientsForRecipes(Spreadsheet $spreadsheet): array
    {
        $recipes = Recipe::all();
        $ingredients = Ingredient::all();
        $count = $spreadsheet->getSheetCount();
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $title = $sheet->getTitle();
            $ingredientNames = $this->getColumn($sheet, 'A', 'name');
            $amount = $this->getColumn($sheet, 'B', 'amount');
            $recipeId = Arr::first($recipes->filter(fn(Recipe $item) => $item->title === $title))?->id;
            $units = $this->getColumn($sheet, 'C', 'unit');
            foreach ($ingredientNames as $key => $ingredient) {
                $ingredientId =
                    Arr::first($ingredients->filter(fn(Ingredient $item) => $item->name === $ingredient['name']))?->id;
                $result[] = [
                    'ingredient_id' => $ingredientId,
                    'recipe_id' => $recipeId,
                    'amount' => $amount[$key]['amount'],
                    'unit' => $units[$key]['unit']
                ];
            }
        }
        return $result;
    }

    public function getStepsForRecipes(Spreadsheet $spreadsheet): array
    {
        $recipes = Recipe::all();
        $count = $spreadsheet->getSheetCount();
        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $sheet = $spreadsheet->getSheet($i);
            $title = $sheet->getTitle();
            $steps = $this->getColumn($sheet, 'D', 'name');
            $recipeId = Arr::first($recipes->filter(fn(Recipe $item) => $item->title === $title))?->id;
            foreach ($steps as $key => $step) {
                $result[] = [
                    'recipe_id' => $recipeId,
                    'title' => $step['name'],
                ];
            }
        }
        return $result;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //Ingredient::query()->delete();
        IngredientsForRecipe::query()->delete();
        Step::query()->delete();
        Recipe::query()->delete();
        Category::query()->delete();
        $spreadsheet = IOFactory::load(storage_path('przepisy_10.xlsx'));
        Category::query()->insert($this->getCategories($spreadsheet));
        Recipe::query()->insert($this->getRecipes($spreadsheet));
        Step::query()->insert($this->getStepsForRecipes($spreadsheet));
        Ingredient::query()->insert($this->getIngredients($spreadsheet));

        IngredientsForRecipe::query()->insert($this->getIngredientsForRecipes($spreadsheet));
        return 0;
    }
}
