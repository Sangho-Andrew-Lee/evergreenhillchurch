<?php

App::uses('AppController', 'Controller');

class SearchController extends AppController {

    public $uses = array();

    public $components = array('Yummly');

    public function index() {

        //Read the count from the config file in /app/Config/bootstrap.php
        $count = Configure::read('number_of_search_results');

        //Get the query param q from the server
        $keyword = $_GET['q'];

        //Search for the recipes using the keyword
        $recipes =  $this->Yummly->recipes($keyword, $count);

        $this->set(array(
            'title_for_layout' => 'ChefMemo - Recipes of ' . $keyword,
            'keyword' => $keyword,
            'recipes' => $recipes
        ));

    }
}
