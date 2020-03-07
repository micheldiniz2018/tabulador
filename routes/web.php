<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('auth.login');
});

Auth::routes();
//direct
Route::get('/home', 'HomeController@index')->name('home');

/** OPERATOR ROUTES **/
$router->group([
    'prefix'    => 'Operator',
    'as'        => 'operator.',
    'middleware' => 'auth'
], function ( \Illuminate\Routing\Router $router ){
    
    //varejo
    $router->group([
        'prefix'    => 'Varejo',
        'as'        => 'varejo.',
    ], function ( \Illuminate\Routing\Router $router ){
        $router->get( '/', [
            'uses' => 'Operator\Varejo\index@index',
            'as'   => 'index'
        ]);

        $router->get( '/RegistrarAcordo', [
            'uses' => 'Operator\Varejo\Preventivo\Acordo@index',
            'as'   => 'index'
        ]);

    });

});

/*
 * BACKOFFICE ROUTES
 *
$router->group( [
    'prefix'    => 'backoffice',
    'as'        => 'backoffice.',
], function ( \Illuminate\Routing\Router $router ){

    //index
    $router->group([
        'prefix'    => 'index',
        'as'        => 'index.',
    ], function ( \Illuminate\Routing\Router $router )
    {
        $router->get( '/', [
            'uses' => 'BackOffice\Pages\indexBackOffice@index',
            'as'   => 'indexbackoffice'
        ]);

        $router->get( '/preventivo', [
            'uses' => 'BackOffice\Pages\Preventivo@index',
            'as'   => 'preventivo.'
        ])->middleware('auth');

        $router->post( '/preventivoSearch/', [
            'uses' => 'BackOffice\Pages\Preventivo@create'
        ])->middleware('auth');

        //export excel accords
        $router->get( '/preventivoExport/{dtstart}/{dtfinish}', [
            'uses' => 'Excel\Preventivo@Export',
            'as'   => 'preventivoexport.'
        ])->middleware('auth');

        $router->get( '/preventivoAcordo/', [
            'uses' => 'BackOffice\Pages\Preventivo@acordo'
        ])->middleware('auth');

        $router->post( '/atualizarAcordo/', [
            'uses' => 'BackOffice\Pages\Preventivo@store'
        ])->middleware('auth');

        $router->get( '/findBackOfficeAcords/', [
            'uses' => 'BackOffice\Pages\Busca\AcordoBackOfficeFind@index'
        ])->middleware('auth');

        //export excel accords
        $router->get( '/backofficeAcordoExport/{dtstart}/{dtfinish}', [
            'uses' => 'Excel\BackOfficeAcordo@Export',
            'as'   => 'backofficeacordoexport.'
        ])->middleware('auth');

        $router->post( '/resultBackOfficeAcords/', [
            'uses' => 'BackOffice\Pages\Busca\AcordoBackOfficeFind@create'
        ])->middleware('auth');

    });


});
*/

/*
 * BACKOFFICE
 */
Route::group(['prefix' => 'backoffice', 'middleware' => 'auth'], function ( ){

   Route::group(['prefix' => 'index'], function (){

       Route::get('/','BackOffice\Pages\indexBackOffice@index');
       Route::get('/preventivo','BackOffice\Pages\Preventivo@index');
       Route::post('/preventivoSearch','BackOffice\Pages\Preventivo@create');
       Route::get('/preventivoExport/{dtstart}/{dtfinish}','Excel\Preventivo@Export');
       Route::get('/preventivoAcordo','BackOffice\Pages\Preventivo@acordo');
       Route::post('/atualizarAcordo','BackOffice\Pages\Preventivo@store');
       Route::get('/findBackOfficeAcords','BackOffice\Pages\Busca\AcordoBackOfficeFind@index');
       Route::get('/backofficeAcordoExport/{dtstart}/{dtfinish}','Excel\BackOfficeAcordo@Export');
       Route::post('/resultBackOfficeAcords','BackOffice\Pages\Busca\AcordoBackOfficeFind@create');
       Route::get('/preventivoPP','BackOffice\Pages\Preventivo\PP@index');
       Route::post('/resultPP','BackOffice\Pages\Preventivo\PP@create');
       Route::get('/backofficePPExport/{dtstart}/{dtfinish}','Excel\Preventivo@ExportPP');
       Route::get('/preventivoDesfavoravel','BackOffice\Pages\Preventivo\Desfavoravel@index');
       Route::post('/resultDesfavoravel','BackOffice\Pages\Preventivo\Desfavoravel@create');
       Route::get('/backofficeDesfavoravelExport/{dtstart}/{dtfinish}','Excel\Preventivo@ExportDesfavoravel');
       //recusa
       Route::get('/preventivoRecusa','BackOffice\Pages\Preventivo\Recusa@index');
       Route::post('/resultRecusa','BackOffice\Pages\Preventivo\Recusa@create');
       Route::get('/backofficeRecusaExport/{dtstart}/{dtfinish}','Excel\Preventivo@ExportRecusa');

   });

});

