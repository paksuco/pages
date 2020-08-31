<?php

namespace Paksuco\Pages\Controllers;

class PagesController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        return view("pages-ui::backend.index", [
            "extends" => config("pages-ui.backend.template_to_extend", "layouts.app")
        ]);
    }
}
