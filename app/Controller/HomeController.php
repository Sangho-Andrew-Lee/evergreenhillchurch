<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

class HomeController extends AppController {

    public $uses = array();

    public $components = array('Yummly');

    public function index() {

        //Read the popular categories from the config file in /app/Config/bootstrap.php
        $popularCategories = Configure::read('popular_categories');

        //Read popular recipes from cache first
        $popularRecipes = Cache::read('popular_recipes', 'short_5_mins');

        //If not cached, then REST it and cache it
        if (!$this->cache || $popularRecipes === false) {

            foreach ($popularCategories as $popularCategory => $popularCategoryOptions) {

                $popularRecipes[$popularCategory] = $this->Yummly->recipes($popularCategory, $popularCategoryOptions['count']);

            }

            Cache::write('popular_recipes', $popularRecipes, 'short_5_mins');

        }

        $this->set(array(
            'title_for_layout' => 'ChefMemo - Ultimate Collection of Recipes',
            'popularCategories' => $popularCategories,
            'popularRecipes' => $popularRecipes
        ));
    }
}
