<?php

App::uses('AppController', 'Controller');

class RecipesController extends AppController {

    public $uses = array();

    public $components = array('Yummly');

    /*
     * All Recipes page (Categories page)
     * URL: /recipes
     */
    public function index() {

        //Read the categories from the config file in /app/Config/bootstrap.php
        $categories = Configure::read('categories');

        //Read the count from the config file in /app/Config/bootstrap.php
        $count = Configure::read('categories_recipes_per_category');

        //Read new recipes from cache first
        $allRecipes = Cache::read('all_recipes', 'short_5_mins');

        //If not cached, then REST it and cache it
        if (!$this->cache || $allRecipes === false) {

            //Each of the category, we are going to use the Yummly API to retrieve the recipe.
            foreach ($categories as $categoryUri => $categoryName) {
                $allRecipes[$categoryUri] = $this->Yummly->recipes($categoryName, $count);
            }

            //Cache this result in the cake level so it can reduce API calls to Yummly.
            Cache::write('all_recipes', $allRecipes, 'short_5_mins');

        }

        $this->set(array(
            'title_for_layout' => 'ChefMemo - All Recipes',
            'categories' => $categories,
            'allRecipes' => $allRecipes
        ));

    }

    /*
     * Single Category page
     * URL: /c/[category]
     */
    public function category($category) {

        //Read the categories from the config file in /app/Config/bootstrap.php
        $categories = Configure::read('categories');

        //Read the count from the config file in /app/Config/bootstrap.php
        $count = Configure::read('recipes_category_recipe_count');

        //Read new recipes from cache first
        $recipes = Cache::read('category_' . $category . '_recipes', 'short_5_mins');

        //If not cached, then REST it and cache it
        if (!$this->cache || $recipes === false) {

            $recipes = $this->Yummly->recipes($categories[$category], $count);

            //Cache this result in the cake level so it can reduce API calls to Yummly.
            Cache::write('category_' . $category . '_recipes', $recipes, 'short_5_mins');

        }

        $this->set(array(
            'title_for_layout' => 'ChefMemo - Recipes of ' . $categories[$category],
            'categories' => $categories,
            'category' => $category,
            'recipes' => $recipes
        ));

    }

    /*
     * Single Recipe page
     * URL: /recipe/[recipe]
     */
    public function view($id) {

        //Read the recipe from cache first
        $recipe = Cache::read('recipe_' . $id, 'short_5_mins');

        //If not cached, then REST it and cache it
        if (!$this->cache || $recipe === false) {

            $recipe = $this->Yummly->recipe($id);

            //Cache this result in the cake level so it can reduce API calls to Yummly.
            Cache::write('recipe_' . $id, $recipe, 'short_5_mins');

        }

        $this->set(
            array(
                'title_for_layout' => 'ChefMemo - Recipe of ' . $recipe['name'],
                'recipe' => $recipe
            )
        );

    }

    /*
     * Full Recipe Preparation page (Cooking Direction page)
     * URL: /recipe/external/[recipe]
     */
    public function external($id) {

        //Read the recipe from cache first
        $recipe = Cache::read('recipe_' . $id, 'short_5_mins');

        //If not cached, then REST it and cache it
        if (!$this->cache || $recipe === false) {

            $recipe = $this->Yummly->recipe($id);

            //Cache this result in the cake level so it can reduce API calls to Yummly.
            Cache::write('recipe_' . $id, $recipe, 'short_5_mins');

        }

        $this->layout = 'external';

        $this->set(
            array(
                'title_for_layout' => 'ChefMemo - Recipe of ' . $recipe['name'],
                'recipe' => $recipe
            )
        );

    }

}
