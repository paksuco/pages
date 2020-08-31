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
    Route::get('/pages', "\Paksuco\Pages\Controllers\PagesController@index")->name("pages")->middleware(config("pages-ui.backend.middleware", []));
});
