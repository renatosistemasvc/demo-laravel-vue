<?php

/** ROTAS INSTITUICAÇÃO **/
Route::group(['prefix' => 'instituicao', 'middleware' => ['auth:api', 'cors']], function(){

	Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\InstituicaoController@getAllPaginate']);
	Route::get('/getAll', ['uses' => 'Api\InstituicaoController@getAll']);
	Route::get('/getById/{id}', ['uses' => 'Api\InstituicaoController@getById']);    
    Route::post('/store',['uses' => 'Api\InstituicaoController@store']);    
    Route::post('/update/{id}',['uses' => 'Api\InstituicaoController@update']);
	Route::delete('/delete/{id}', ['uses' => 'Api\InstituicaoController@delete']);
});

/** ROTAS ESTADO **/
Route::group(['prefix' => 'estado', 'middleware' => ['auth:api', 'cors']], function(){

    Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\EstadoController@getAllPaginate']);
    Route::get('/getAll', ['uses' => 'Api\EstadoController@getAll']);
    Route::get('/getById/{id}', ['uses' => 'Api\EstadoController@getById']);
    Route::post('/store',['uses' => 'Api\EstadoController@store']);
    Route::post('/update/{id}',['uses' => 'Api\EstadoController@update']);
    Route::delete('/delete/{id}', ['uses' => 'Api\EstadoController@delete']);
});

/** ROTAS CIDADE **/
Route::group(['prefix' => 'cidade', 'middleware' => ['auth:api', 'cors']], function(){

    Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\CidadeController@getAllPaginate']);
    Route::get('/getAll', ['uses' => 'Api\CidadeController@getAll']);
    Route::get('/getById/{id}', ['uses' => 'Api\CidadeController@getById']);
    Route::post('/store',['uses' => 'Api\CidadeController@store']);
    Route::post('/update/{id}',['uses' => 'Api\CidadeController@update']);
    Route::delete('/delete/{id}', ['uses' => 'Api\CidadeController@delete']);
    Route::post('/getCidadeByNomePaginate', ['uses' => 'Api\CidadeController@getCidadeByNomePaginate']);
    Route::post('/searchByNome', ['uses' => 'Api\CidadeController@searchByNome']);
});

/** ROTAS LOGRADOUORO **/
Route::group(['prefix' => 'logradouro', 'middleware' => ['auth:api', 'cors']], function(){

    Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\LogradouroController@getAllPaginate']);
    Route::get('/getAll', ['uses' => 'Api\LogradouroController@getAll']);
    Route::get('/getById/{id}', ['uses' => 'Api\LogradouroController@getById']);
    Route::post('/store',['uses' => 'Api\LogradouroController@store']);
    Route::post('/update/{id}',['uses' => 'Api\LogradouroController@update']);
    Route::delete('/delete/{id}', ['uses' => 'Api\LogradouroController@delete']);
    Route::post('/searchByNome', ['uses' => 'Api\LogradouroController@searchByNome']);
});

/** ROTAS BAIRRO **/
Route::group(['prefix' => 'bairro', 'middleware' => ['auth:api', 'cors']], function(){

    Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\BairroController@getAllPaginate']);
    Route::get('/getById/{id}', ['uses' => 'Api\BairroController@getById']);
    Route::post('/store',['uses' => 'Api\BairroController@store']);
    Route::post('/update/{id}',['uses' => 'Api\BairroController@update']);
    Route::delete('/delete/{id}', ['uses' => 'Api\BairroController@delete']);
    Route::post('/searchByNome', ['uses' => 'Api\BairroController@searchByNome']);
});

/** ROTAS CEP / ENDEREÇOS **/
Route::group(['prefix' => 'cep', 'middleware' => ['auth:api', 'cors']], function(){

    Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\CepController@getAllPaginate']);
	Route::get('/getById/{id}', ['uses' => 'Api\CepController@getById']);
	Route::post('/store',['uses' => 'Api\CepController@store']);
	Route::post('/update/{id}',['uses' => 'Api\CepController@update']);
    Route::delete('/delete/{id}', ['uses' => 'Api\CepController@delete']);
    Route::get('/getEnderecoByCep/{cep}', ['uses' => 'Api\CepController@getEnderecoByCep']);
    Route::post('/getByFiltrosPaginate', ['uses' => 'Api\CepController@getByFiltrosPaginate']);
});

/** ROTAS MODELO **/
Route::group(['prefix' => 'modelo', 'middleware' => ['auth:api', 'cors']], function(){

	Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\ModeloController@getAllPaginate']);
	Route::get('/getById/{id}', ['uses' => 'Api\ModeloController@getById']);
	Route::post('/store',['uses' => 'Api\ModeloController@store']);
	Route::post('/update/{id}',['uses' => 'Api\ModeloController@update']);
	Route::delete('/delete/{id}', ['uses' => 'Api\ModeloController@delete']);
});

/** ROTAS USUARIO **/
Route::group(['prefix' => 'usuario', 'middleware' => ['auth:api', 'cors']], function(){

    Route::get('/getUsuarioLogado', ['uses' => 'Api\UsuarioController@getUsuarioLogado']);
	Route::post('/getAllPaginate/{filtro?}', ['uses' => 'Api\UsuarioController@getAllPaginate']);
	Route::post('/store',['uses' => 'Api\UsuarioController@store']);
	Route::get('/getById/{id}', ['uses' => 'Api\UsuarioController@getById']);
	Route::post('/update/{id}',['uses' => 'Api\UsuarioController@update']);
	Route::delete('/delete/{id}', ['uses' => 'Api\UsuarioController@delete']);
});