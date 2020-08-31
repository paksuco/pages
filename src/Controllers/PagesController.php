<?php

namespace Paksuco\Pages\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PagesController extends basecontroller
{
    public function index()
    {
        return view("pages-ui::backend.index", [
            "extends" => config("pages-ui.backend.template_to_extend", "layouts.app")
        ]);
    }
}
