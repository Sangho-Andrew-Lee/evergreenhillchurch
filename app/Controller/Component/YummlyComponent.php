<?php

App::uses('Component', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class YummlyComponent extends Component {

    /**
     * REST GET the recipes by the given keyword
     */
    protected function __getRecipes($keyword, $count) {

        $HttpSocket = new HttpSocket();

        $appId = Configure::read('api.recipes.yummly.app_id');
        $appKey = Configure::read('api.recipes.yummly.app_key');

        $results = $HttpSocket->get(
            'http://api.yummly.com/v1/api/recipes',
            array(
                '_app_id' => $appId,
                '_app_key' => $appKey,
                'q' => $keyword,
                'maxResult' => $count
            )
        );

        return $results;

    }

    /**
     * Get the recipes (REST GET first, then parse it)
     */
    public function recipes($keyword, $count) {

        $recipes = $this->__getRecipes($keyword, $count);

        $currentRecipes = json_decode($recipes['body'], true);
        $parsedRecipes = array();

        foreach ($currentRecipes['matches'] as $i => $recipe){
            if (isset($recipe['imageUrlsBySize'])) {
                $parsedRecipes[$i]['id']    = $recipe['id'];
                $parsedRecipes[$i]['title'] = $recipe['recipeName'];

                if (count($recipe['imageUrlsBySize']) >= 1) {
                    $_imgId = substr($recipe['imageUrlsBySize']['90'], 0, -4);

                    $parsedRecipes[$i]['image'] = array(
                        'sm' => $_imgId . '90-c',
                        'md' => $_imgId . '200-c',
                        'lg' => $_imgId . '500-c',
                        'hd' => $_imgId . '1200-c'
                    );
                }
            }
        }

        return $parsedRecipes;
    }

    /**
     * REST GET a recipe by the given recipe ID
     */
    protected function __getRecipe($id) {

        $HttpSocket = new HttpSocket();

        $appId = Configure::read('api.recipes.yummly.app_id');
        $appKey = Configure::read('api.recipes.yummly.app_key');

        $results = $HttpSocket->get(
            'http://api.yummly.com/v1/api/recipe/' . $id,
            array(
                '_app_id' => $appId,
                '_app_key' => $appKey
            )
        );

        return $results;
    }

    /**
     * Get a recipe (REST GET first, then parse it)
     */
    public function recipe($id) {

        $recipe = $this->__getRecipe($id);

        $currentRecipe = json_decode($recipe['body'], true);

        $parsedRecipe['id']               = $currentRecipe['id'];
        $parsedRecipe['name']               = $currentRecipe['name'];
        $parsedRecipe['totalTime']          = $currentRecipe['totalTime'];
        $parsedRecipe['numberOfServings']   = $currentRecipe['numberOfServings'];
        $parsedRecipe['ingredientLines']    = $currentRecipe['ingredientLines'];

        if (count($currentRecipe['images'][0]['imageUrlsBySize']) >= 1) {
            $_imgId = substr($currentRecipe['images'][0]['imageUrlsBySize']['90'], 0, -4);

            $parsedRecipe['image'] = array(
                'sm' => $_imgId . '90-c',
                'md' => $_imgId . '200-c',
                'lg' => $_imgId . '500-c',
                'hd' => $_imgId . '1200-c'
            );
        }

        $parsedRecipe['direction']= array(
            'url'       => $currentRecipe['source']['sourceRecipeUrl'],
            'name'      => $currentRecipe['source']['sourceDisplayName'],
            'website'   => $currentRecipe['source']['sourceSiteUrl']
        );

        return $parsedRecipe;

    }
























}