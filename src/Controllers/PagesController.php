<?php

namespace Paksuco\Pages\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Paksuco\Pages\Models\Page;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(20);
        return view("pages-ui::backend.index", [
            "extends" => config("pages-ui.backend.template_to_extend", "layouts.app"),
            "pages" => $pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages-ui::backend.form", [
            "extends" => config("pages-ui.backend.template_to_extend", "layouts.app"),
            "edit" => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|filled",
            "content" => "required|filled",
            "publish" => "required|filled",
        ]);

        $page = new Page();
        $page->page_title = $request->title;
        $page->page_content = $request->content;
        $page->page_slug = Str::slug($request->title);
        $page->page_excerpt = Str::limit($request->content, 200, '...');
        $page->published = $request->publish == "1" ? true : false;
        $page->save();

        return redirect()->route("paksuco.pages.index")->with("status", "success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);

        return view("pages-ui::frontend.show", [
            "page" => $page,
            "extends" => config("pages-ui.frontend.template_to_extend", "layouts.app"),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view("pages-ui::backend.form", [
            "extends" => config("pages-ui.backend.template_to_extend", "layouts.app"),
            "edit" => true,
            "page" => $page
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title" => "required|filled",
            "content" => "required|filled",
            "publish" => "required|filled",
        ]);

        $page = Page::findOrFail($id);
        $page->page_title = $request->title;
        $page->page_content = $request->content;
        $page->page_slug = Str::slug($request->title);
        $page->page_excerpt = Str::limit($request->content, 200, '...');
        if ($request->publish != "0") {
            $page->published = $request->publish == "1" ? true : false;
        }
        $page->save();

        return redirect()->route("paksuco.pages.index")->with("status", "success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if ($page instanceof Page) {
            $page->delete();
        }
        return redirect()->route("paksuco.pages.index")->with("sucess", "Page has been successfully deleted.");
    }
}
