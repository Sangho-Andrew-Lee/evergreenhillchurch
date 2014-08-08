<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array('Yummly');

    public $cache = false;

    public function beforeFilter() {

        //Check if Yummly API keys are entered
        $yummlyApi = Configure::read('api.recipes.yummly');
        if ($yummlyApi['app_id'] == 'Yummly App ID' || $yummlyApi['app_key'] == 'Yummly App Key') {
            echo 'Please enter Yummly API ID and API Key into the file ' . APP . 'Config' . DS . 'bootstrap.php';
            exit;
        }

        //Use cache or not
        $this->cache = Configure::read('cache');

        //Read the categories from the config file in /app/Config/bootstrap.php
        $categories = Configure::read('categories');

        //Read new recipes from cache first
        $newRecipes = Cache::read('new_recipes', 'short_5_mins');

        //If not cached, then REST it and cache it
        if (!$this->cache || $newRecipes === false) {

            //Randomize the the order of the categories
            $randomCategories = array_rand($categories, 8);

            //Each of the category, we are going to use the Yummly API to retrieve the recipe.
            foreach ($randomCategories as $categoryUri => $categoryName) {

                $singleRecipe = $this->Yummly->recipes($categoryName, 1);
                $newRecipes[] = $singleRecipe[0];

            }

            //Cache this result in the cake level so it can reduce API calls to Yummly.
            Cache::write('new_recipes', $newRecipes, 'short_5_mins');

        }

        $this->set(array(
            'newRecipes' => $newRecipes
        ));

    }

}
