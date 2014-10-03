<?php


Route::group([
        'prefix' => 'api',
        'before' => 'api.auth|api.limit'
    ], function() {

        Route::group([
                'prefix' => 'v1',
            ], function() {


                /*
                |--------------------------------------------------------------------------
                | Posts Routes
                |--------------------------------------------------------------------------
                */
                Route::group([
                        'prefix' => 'posts',
                    ], function() {

                        Route::get('/', [
                                'as'    => 'posts.index',
                                'uses'  => 'PostsController@index'
                            ]);

                        Route::get('/create', [
                                'as'    => 'posts.create',
                                'uses'  => 'PostsController@create'
                            ]);

                        Route::post('/', [
                                'as'    => 'posts.store',
                                'uses'  => 'PostsController@store'
                            ]);

                        Route::get('/{id}', [
                                'as'    => 'posts.show',
                                'uses'  => 'PostsController@show'
                            ]);

                        Route::get('/{id}/edit', [
                                'as'    => 'posts.edit',
                                'uses'  => 'PostsController@edit'
                            ]);

                        Route::put('/{id}', [
                                'as'    => 'posts.update',
                                'uses'  => 'PostsController@update'
                            ]);

                        Route::delete('/{id}', [
                                'as' => 'posts.destroy',
                                'uses' => 'PostsController@destroy'
                            ]);

                    });







            });
    });




    /*
    |--------------------------------------------------------------------------
    | CATCH WRONG ROUTES
    |--------------------------------------------------------------------------
    */
    App::missing(function()
        {
            return 'You are in the wrong place';
        });
