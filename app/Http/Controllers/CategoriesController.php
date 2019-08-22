<?php

namespace App\Http\Controllers;
use App\Category;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $parents = Category::with('translations')->where('parent_id', null)->get();
        $display = [];
        $display[''] = trans('common.choose_parent_category');
        foreach ($parents as $parent) {
            $display[$parent->id] = $parent->title;
        }

        return view('admin.category.form', compact('display'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();

        $slug = Str::slug($data['title_vi']);
        $slugCount = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        $slug = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;

        Category::create([
            'parent_id' => !empty($data['parent_id']) ?  $data['parent_id'] : null,
            'slug' => $slug,
            'vi' => ['title' => $data['title_vi'], 'seo_title' => $data['seo_title_vi']],
            'en' => ['title' => !empty($data['title_en'])? $data['title_en'] : null, 'seo_title' => !empty($data['seo_title_en'])? $data['seo_title_en'] : null],
            'fr' => ['title' => !empty($data['title_fr'])? $data['title_fr'] : null, 'seo_title' => !empty($data['seo_title_fr'])? $data['seo_title_fr'] : null],

        ]);

        flash(trans('common.category_create_success'), 'success');

        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param Request $request
     * @return Response
     */
    public function show($id, Request $request)
    {

        $category = Category::find($id);

        $cateIds = ($category->subCategories->count() > 0)? Category::where('parent_id', $id)->pluck('id') : array($id);

        if ($request->input('q')) {
            $searchPost = urldecode($request->input('q'));
            $posts = Post::whereHas('translations', function($q) use ($searchPost){
                $q->where('title', 'LIKE', '%'.$searchPost.'%')
                    ->where('locale', 'vi');
            })->whereIn('category_id', $cateIds)->latest()->paginate(10);
        } else {
            $posts = Post::whereIn('category_id', $cateIds)->latest()->paginate(10);
            $searchPost = '';
        }
        return view('admin.category.show', compact('posts', 'searchPost', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $parents = Category::with('translations')->where('parent_id', null)->get();
        $display = [];
        $display[''] = trans('common.choose_parent_category');
        foreach ($parents as $parent) {
            $display[$parent->id] = $parent->title;
        }
        $category = Category::with('translations')->find($id);
        return view('admin.category.form', compact('display', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CategoryRequest $request
     * @return Response
     */
    public function update($id, CategoryRequest $request)
    {
        $data = $request->all();

        $category = Category::find($id);
        if (!empty($data['parent_id'])) {
            DB::table('posts')->where('category_id', $data['parent_id'])
                              ->update(['category_id' => $category->id]);
            $category->parent_id = $data['parent_id'];
        } else {
            $category->parent_id = null;
        }

        if (!empty($data['title_vi'])) {
            //generate slug again.
           /* if ($category->translateOrNew('vi')->title != $data['title_vi']) {
                $slug = Str::slug($data['title_vi']);
                $slugCount = Category::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                $category->slug = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
            }*/
            $category->translateOrNew('vi')->title = $data['title_vi'];
        }
        if (!empty($data['title_en'])) {
            $category->translateOrNew('en')->title = $data['title_en'];
        }
        if (!empty($data['title_fr'])) {
            $category->translateOrNew('fr')->title = $data['title_fr'];
        }

        if (!empty($data['seo_title_vi'])) {
            $category->translateOrNew('vi')->title = $data['seo_title_vi'];
        }

        if (!empty($data['seo_title_en'])) {
            $category->translateOrNew('en')->title = $data['seo_title_en'];
        }
        if (!empty($data['seo_title_fr'])) {
            $category->translateOrNew('fr')->title = $data['seo_title_fr'];
        }


        $category->save();

        flash(trans('common.category_edit_success'), 'success');
        return redirect('admin/categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        DB::table('posts')->where('category_id', $category->id)->delete();
        $category->delete();
        flash(trans('common.category_delete_success'), 'success');
        return redirect('admin/categories');
    }
}
