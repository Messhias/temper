<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


$resources = [
    'api/routes'
];

/**
 * Mapping all the resources to be included on the routes.
 */
array_map(fn ($resource) => include_once __DIR__ . "/{$resource}.php", $resources);
