<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tags = Tag::paginate(20);
        return view('admin.tag.index', compact('tags'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.form', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();

        $tag = Tag::find($id);

        if ($request->file('banner_image') && $request->file('banner_image')->isValid()) {
            $tag->banner_image = $this->saveImage($request->file('banner_image'), $tag->banner_image);
        }
        
        if (isset($data['banner_link']) && $data['banner_link']) {
            $tag->banner_link = $data['banner_link'];
        }
        
        $tag->save();

        flash('Tag edit success', 'success');
        return redirect('admin/tags');
    }
}
