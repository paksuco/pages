<?php

use Illuminate\Support\Facades\Route;

/**
 * Routes for the package would go here
 */

Route::group([
    'layout' => config("pages-ui.backend.template_to_extend", "layouts.app"),
    'prefix' => config("pages-ui.backend.admin_route_prefix", ""),
    'as' => 'paksuco.',
], function () {

    Route::post("/pages/upload", "\Paksuco\Pages\Controllers\PagesController@upload")
        ->name("pages.upload")
        ->middleware(config("pages-ui.backend.middleware", []));

    Route::resource('/pages', "\Paksuco\Pages\Controllers\PagesController")
        ->except(["show"])
        ->names("pages")
        ->middleware(config("pages-ui.backend.middleware", []));
});

Route::group([
    'layout' => config("pages-ui.frontend.template_to_extend", "layouts.app"),
    'prefix' => config("pages-ui.frontend.frontend_route_prefix", ""),
    'as' => 'paksuco.',
], function () {
    Route::get('/{page}', "\Paksuco\Pages\Controllers\PagesController@show")
        ->name("pages.show")
        ->middleware(config("pages-ui.frontend.middleware", []));
});
