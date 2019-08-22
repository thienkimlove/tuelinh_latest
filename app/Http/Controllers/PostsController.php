<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Module;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends BaseController
{
    public $modules, $display;
    public function __construct()
    {
        parent::__construct();
        $this->modules = [
        'dai-cuong-ve-benh' => 'Hiện thị list  bên phải đại cương về bệnh',
        'thuoc-nam-tri-benh' => 'Hiện thị list  bên phải thuoc nam tri benh',
        'tim-thuoc-theo-benh' => 'Hiện thị list  bên phải tim thuoc theo benh',
        'footer-san-pham' => 'Hiện thị danh sách tin footer',
         'tin-tuc-noi-bat' => 'Hiện thị tin tức noi bat bên phải',
         'tin-tuc-lien-quan' => 'Hiện thị tin tức lien quan bên phải',
         'chuan-hoa-nguyen-lieu' => 'Hiện thị trong mục Chuẩn Hóa Vùng nguyên liệu trang chủ',
         'san-pham-trang-chu' => 'Hiện thị trong mục Sản phẩm trang chủ',
         'tu-thien-trang-chu' => 'Hiện thị trong mục Hoạt động từ thiện trang chủ',
         'tin-tuc-trang-chu' => 'Hiện thị trong mục Tin tức trang chủ',
    ];
        $categories = Category::with('translations')->get();
        $this->display = [];
        foreach ($categories as $category) {
            if ($category->parent_id != null || $category->subCategories->count() == 0)
                $this->display[$category->id] = $category->title;
        }
    }

    protected function syncTags($post, $tag_list)
    {
        $tagIds = [];
        foreach ($tag_list as $tag) {
            $tagCount = Tag::where('title', $tag)->first();
            if ($tagCount) {
                $tagIds[] = $tagCount->id;
            } else {
                $slug = Str::slug($tag);
                $slugCount = Tag::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
                $slug = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
                $tagIds[] = Tag::create(['title' => $tag, 'slug' => $slug])->id;
            }
        }
        $post->tags()->sync($tagIds);
    }

    protected function syncModules($data, $post)
    {
        if (!empty($data['modules'])) {
            foreach ($data['modules'] as $key => $values) {
                if (isset($values['display'])) {
                    $order = (int) $values['order'];
                    $module = Module::where('post_id', $post->id)
                        ->where('slug', $key)
                        ->first();
                    if ($module) {
                        $module->order = $order;
                        $module->save();
                    } else {
                        Module::create([
                            'post_id' => $post->id,
                            'slug' => $key,
                            'order' => $order,
                        ]);
                    }
                } else {
                    Module::where('slug', $key)
                        ->where('post_id', $post->id)
                        ->delete();
                }
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->input('q')) {
            $searchPost = urldecode($request->input('q'));
            $posts = Post::whereHas('translations', function($q) use ($searchPost){
                $q->where('title', 'LIKE', '%'.$searchPost.'%')
                    ->where('locale', 'vi');
            })->latest('updated_at')->paginate(20);
        } else {
            $posts = Post::latest('updated_at')->paginate(20);
            $searchPost = '';
        }

        return view('admin.post.index', compact('posts', 'searchPost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('title', 'title');
        $modules = $this->modules;
        $display = $this->display;
        return view('admin.post.form', compact('display', 'tags', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();

        $insert = [
            'category_id' => $data['category_id'],
            'tieude' => $data['tieude'],
            'status' => (!empty($data['status']) && $data['status'] == 'on') ? true : false,
            'image' => ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '',
            'footer_image' => ($request->file('footer_image') && $request->file('footer_image')->isValid()) ? $this->saveImage($request->file('footer_image')) : ''
        ];

        foreach (['vi', 'en', 'fr'] as $lang) {
            foreach (['title', 'content', 'desc'] as $field) {
                $insert[$lang][$field] = !empty($data[$field.'_'.$lang])? $data[$field.'_'.$lang] : '';
            }
        }

        $post = Post::create($insert);

        if (!empty($data['tag_list']) && $data['tag_list']) {
            $this->syncTags($post, $data['tag_list']);
        }
        $this->syncModules($data, $post);

        flash(trans('common.post_create_success'), 'success');
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all()->pluck('title', 'title');
        $modules = $this->modules;
        $display = $this->display;
        return view('admin.post.form', compact('post', 'display', 'tags', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param PostRequest $request
     * @return Response
     */
    public function update($id, PostRequest $request)
    {
        $data = $request->all();
        $post = Post::find($id);


        foreach (['title', 'content', 'desc'] as $field) {
            foreach (['vi', 'en', 'fr'] as $lang) {
                $post->translateOrNew($lang)->$field = !empty($data[$field.'_'.$lang])? $data[$field.'_'.$lang] : '';
            }
        }

        if ($request->file('image') && $request->file('image')->isValid()) {
            $post->image = $this->saveImage($request->file('image'), $post->image);
        }
        if ($request->file('footer_image') && $request->file('footer_image')->isValid()) {
            $post->footer_image = $this->saveImage($request->file('footer_image'), $post->footer_image);
        }
        $post->tieude = $data['tieude'];
        $post->category_id = $data['category_id'];
        $post->status = (!empty($data['status']) && $data['status'] == 'on') ? true : false;

        $post->save();
        if (!empty($data['tag_list']) && $data['tag_list']) {
            $this->syncTags($post, $data['tag_list']);
        }

        $this->syncModules($data, $post);

        flash(trans('common.post_edit_success'), 'success');
        return redirect('admin/posts');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (file_exists(public_path('files/images/' . $post->image))) {
            @unlink(public_path('files/images/' . $post->image));
        }
        if (file_exists(public_path('files/images/' . $post->footer_image))) {
            @unlink(public_path('files/images/' . $post->footer_image));
        }
        $post->delete();
        flash(trans('common.post_delete_success'), 'success');
        return redirect('admin/posts');
    }
}
