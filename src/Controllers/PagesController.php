<?php

namespace Paksuco\Pages\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
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
            "title" => "required|filled"
        ]);

        $request->merge(["slug" => Str::slug($request->title)]);

        $request->validate([
            "slug" => "unique:pages,page_slug,NULL,id",
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

        return redirect()->route("paksuco.pages.index")->with("success", "Page has been successfully saved.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
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
    public function edit(Page $page)
    {
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
    public function update(Request $request, Page $page)
    {
        $request->validate([
            "title" => "required|filled"
        ]);

        $request->merge(["slug" => Str::slug($request->title)]);

        $request->validate([
            "slug" => "unique:pages,page_slug,".$page->id.",id",
            "content" => "required|filled",
            "publish" => "required|filled",
        ]);

        $page->page_title = $request->title;
        $page->page_content = $request->content;
        $page->page_slug = Str::slug($request->title);
        $page->page_excerpt = Str::limit($request->content, 200, '...');
        if ($request->publish != "0") {
            $page->published = $request->publish == "1" ? true : false;
        }
        $page->save();

        return redirect()
            ->route("paksuco.pages.index")
            ->with("success", "Page has been successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()
            ->route("paksuco.pages.index")
            ->with("success", "Page has been successfully deleted.");
    }

    public function upload(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message' => $validation->errors()->all(),
            ], 400);
        }

        $image = $request->file('file');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $path = config('pages-ui::backend.image_upload_folder', public_path('uploads'));
        $image->move($path, $new_name);

        $url = str_replace(public_path(), '', $path . "/" . $new_name);

        return response()->json([
            'location' => $url
        ]);
    }
}
