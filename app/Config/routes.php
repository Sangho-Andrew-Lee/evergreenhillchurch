<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
Router::connect('/', array('controller' => 'home', 'action' => 'index'));

Router::connect('/recipe/:id', array('controller' => 'recipes', 'action' => 'view'), array('pass' => array('id')));

Router::connect('/recipe/external/:id', array('controller' => 'recipes', 'action' => 'external'), array('pass' => array('id')));

Router::connect('/c/:category', array('controller' => 'recipes', 'action' => 'category'), array('pass' => array('category')));

Router::connect('/about-us', array('controller' => 'pages', 'action' => 'staticPage', 'about_us'));

Router::connect('/contact-us', array('controller' => 'pages', 'action' => 'staticPage', 'contact_us'));

Router::connect('/privacy-policy', array('controller' => 'pages', 'action' => 'staticPage', 'privacy_policy'));

Router::connect('/blogs', array('controller' => 'pages', 'action' => 'staticPage', 'blogs'));

Router::connect('/error', array('controller' => 'pages', 'action' => 'staticPage', 'error'));

Router::connect('/general', array('controller' => 'pages', 'action' => 'staticPage', 'general'));

Router::connect('/nutrition', array('controller' => 'pages', 'action' => 'staticPage', 'nutrition'));

Router::connect('/blog', array('controller' => 'pages', 'action' => 'staticPage', 'blog_single'));

Router::connect('/components', array('controller' => 'pages', 'action' => 'staticPage', 'components'));

Router::connect('/terms', array('controller' => 'pages', 'action' => 'staticPage', 'terms'));

Router::connect('/search/*', array('controller' => 'search', 'action' => 'index'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
