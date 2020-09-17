<?php

namespace Paksuco\Pages\Tables;

use Illuminate\Support\Str;

class PagesTable extends \Paksuco\Table\Contracts\TableSettings
{
    public $model = \Paksuco\Pages\Models\Page::class;
    public $queryable = true;
    public $sortable = true;
    public $pageable = true;
    public $perPages = [10, 25, 50, 100];
    public $perPage = 10;

    public $fields = [
        [
            "title" => "#",
            "name" => "id",
            "type" => "field",
            "format" => "string",
            "sortable" => true,
            "queryable" => false,
            "filterable" => false,
        ],
        [
            "title" => "Page Title",
            "name" => "page_title",
            "type" => "field",
            "format" => "string",
            "sortable" => true,
            "queryable" => true,
            "filterable" => true,
        ],
        [
            "title" => "Excerpt",
            "name" => "page_excerpt",
            "type" => "callback",
            "format" => PagesTable::class . "::getExcerpt",
            "sortable" => true,
            "queryable" => true,
            "filterable" => false,
        ],
        [
            "title" => "Published?",
            "name" => "published",
            "type" => "field",
            "format" => "checkbox",
            "sortable" => true,
            "queryable" => false,
            "filterable" => true,
        ],
        [
            "title" => "Updated At",
            "name" => "updated_at",
            "type" => "field",
            "format" => "datetime",
            "sortable" => true,
            "queryable" => false,
            "filterable" => false,
        ],
        [
            "title" => "Created At",
            "name" => "created_at",
            "type" => "field",
            "format" => "datetime",
            "sortable" => true,
            "queryable" => false,
            "filterable" => false,
        ],
        [
            "title" => "Actions",
            "name" => "actions",
            "type" => "callback",
            "format" => PagesTable::class . "::getActions",
            "sortable" => false,
            "queryable" => false,
            "filterable" => false,
        ],
    ];

    public static function getExcerpt($item)
    {
        return wordwrap(Str::limit(strip_tags($item->page_excerpt), 100), 35, "<br>");
    }

    public static function getActions($item)
    {
        return "<a href='". route("paksuco.pages.show", $item->page_slug) . "'>
            <button type='button' class='mr-1 rounded px-3 py-1 bg-gray-700 text-white shadow'>" .
                __("View") . "
            </button>
        </a>
        <a href='". route("paksuco.pages.edit", $item->page_slug) . "'>
            <button type='button' class='mr-1 rounded px-3 py-1 bg-indigo-700 text-white shadow'>" .
                __("Edit") . "
            </button>
        </a>
        <form action='" . route("paksuco.pages.destroy", $item->page_slug) . "' method='POST'>
            <input name='_token'  type='hidden' value='".csrf_token()."'>
            <input name='_method' type='hidden' value='DELETE'>
            <button type='submit' class='rounded px-3 py-1 bg-red-700 text-white shadow'>" .
                __("Delete") .
            "</button>
        </form>";
    }
}
