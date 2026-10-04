<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/
/** @var object $router **/

$router->get('/', 'AuthController@login');
$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@register');
$router->post('/logout', 'AuthController@logout');

$router->get('/products', 'ProductController@index')->middleware('auth');
$router->get('/products/create', 'ProductController@create')->middleware('auth');
$router->post('/products', 'ProductController@store')->middleware('auth');
$router->get('/products/edit/{id}', 'ProductController@edit')->middleware('auth');
$router->post('/products/{id}', 'ProductController@update')->middleware('auth');
$router->post('/products/delete/{id}', 'ProductController@delete')->middleware('auth');

if (defined('IS_CLI') && IS_CLI) {
	$router->get('create-migration/{migration_class}', 'MigrationController::create_migration');
	$router->get('migrate', 'MigrationController::migrate');
	$router->get('rollback', 'MigrationController::rollback');
	$router->get('rollback-all', 'MigrationController::rollback_all');
	$router->get('refresh', 'MigrationController::refresh');
	$router->get('status', 'MigrationController::status');
} else {
	$router->post('create-migration/{migration_class}', 'MigrationController::create_migration')->middleware('auth');
	$router->post('migrate', 'MigrationController::migrate')->middleware('auth');
	$router->post('rollback', 'MigrationController::rollback')->middleware('auth');
	$router->post('rollback-all', 'MigrationController::rollback_all')->middleware('auth');
	$router->post('refresh', 'MigrationController::refresh')->middleware('auth');
	$router->get('status', 'MigrationController::status')->middleware('auth');
}

$router->post('/api/login', 'ApiController@login');
$router->post('/api/create', 'ApiController@create');
$router->post('/api/register', 'ApiController@register');
$router->post('/api/refresh', 'ApiController@refresh');
$router->post('/api/logout', 'ApiController@logout');
$router->get('/api/profile', 'ApiController@profile');
$router->get('/api/list', 'ApiController@list_users');
$router->put('/api/update/{id}', 'ApiController@update_user');
$router->delete('/api/delete/{id}', 'ApiController@delete_user');
$router->get('/api/products', 'ApiController@index');
$router->post('/api/products', 'ApiController@store');
$router->put('/api/products/{id}', 'ApiController@update');
$router->patch('/api/products/{id}', 'ApiController@update');
$router->delete('/api/products/{id}', 'ApiController@delete');
$router->options('/api/login', 'ApiController@options');
$router->options('/api/create', 'ApiController@options');
$router->options('/api/register', 'ApiController@options');
$router->options('/api/refresh', 'ApiController@options');
$router->options('/api/logout', 'ApiController@options');
$router->options('/api/profile', 'ApiController@options');
$router->options('/api/list', 'ApiController@options');
$router->options('/api/update/{id}', 'ApiController@options');
$router->options('/api/delete/{id}', 'ApiController@options');
$router->options('/api/products', 'ApiController@options');
$router->options('/api/products/{id}', 'ApiController@options');
