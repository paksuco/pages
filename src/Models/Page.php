<?php

namespace Paksuco\Pages\Models;

use \Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    public function getRouteKeyName()
    {
        return "page_slug";
    }
}
