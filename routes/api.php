<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Api\ApiCoursController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
        'middleware'=> 'api',
        'namespace' => 'App\Http\Controllers\Api',
        'prefix' => 'user'
    ],
    function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
        Route::post('refresh', 'AuthController@refresh');

        // Routes pour les cours de l'utilisateur connecter
        Route::get('cours', 'CoursController@index');
        Route::get('cours/{cours}', 'CoursController@show');
        Route::get('cours/{cours}/evaluations', 'CoursController@getEvaluations');
        Route::post('cours', 'CoursController@store');
        Route::put('cours/{cours}', 'CoursController@update');
        Route::delete('cours/{cours}', 'CoursController@destroy');

        Route::get('cours/{cours}/ponderation', 'CoursController@getSumPonderation');

        //Route pour les evenemts de l'utilisateur connecter
        Route::get('evenements', 'EvenementController@index');
        Route::post('evenements', 'EvenementController@store');
        Route::put('evenements/{evenemets}', 'EvenementController@update');
        

});

Route::group([
    'middleware'=> 'api',
    'namespace' => 'App\Http\Controllers\Api',
],
function ($router) {
    Route::ApiResources([
        'ecoles' => ApiEcoleController::class,
        'sections' => ApiSectionController::class,
        'typeEvaluations'=>TypeEvaluationController::class,
        'cours'=> ApiCoursController::class,
        'evaluations' => ApiEvaluationController::class
    ]);

});

Route::group([
    'middleware'=> 'api',
    'namespace' => 'App\Http\Controllers\Api',
],
function ($router) {
    Route::get('cours/{cours}/typeEvaluations', 'CoursController@getTypeEvaluations');
    Route::get('cours/{cours}/evaluations', 'CoursController@getEvaluations');
    Route::get('sections/{sections}/cours', 'ApiSectionController@getCours');
    Route::get('typeEvaluations/{typeEvaluation}/evaluations', 'TypeEvaluationController@getEvaluations');

    Route::get('evenements/{evenemets}', 'EvenementController@show');
    Route::delete('evenements/{evenemets}', 'EvenementController@destroy');
});
    
