<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Post;
use App\Setting;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

/*
 * Step to import phan phoi
 * 1. upload the xls file to public/xls
 * 2. Edit the $products array below
 * 3. open the browser and run http://tuelinh.vn/import
 */

Route::get('convert', function(){

});

Route::get('import', function(){

    dd('exit');

    $products = [
        ['name' => 'Cà Gai Leo ', 'file' => 'pp/ca-gai-leo.xls'],
        ['name' => 'Chay Tuệ Linh', 'file' => 'pp/chay-tue-linh.xls'],
        ['name' => 'Dầu gấc Tuệ Linh', 'file' => 'pp/dau-gac.xls'],
        ['name' => 'Dầu tỏi Tuệ Linh', 'file' => 'pp/dau-toi.xls'],
        ['name' => 'Dưỡng thận Tuệ Linh', 'file' => 'pp/duong-than.xls'],
        ['name' => 'Giải độc gan viên', 'file' => 'pp/giai-doc-gan-vien-60.xls'],
        ['name' => 'Sâm nhung cường lực Tuệ Linh', 'file' => 'pp/sam-nhung-cuong-luc.xls'],
        ['name' => 'Giảo Cổ Lam viên', 'file' => 'pp/giao-co-lam-vien-60.xls'],
        ['name' => 'Lycoeye', 'file' => 'pp/lycoeye.xls'],
        ['name' => 'Lycoskin', 'file' => 'pp/lycoskin.xls'],
        ['name' => 'Trà giải độc gan', 'file' => 'pp/tra-giai-doc-gan.xls'],
        ['name' => 'Trà Giảo Cổ Lam', 'file' => 'pp/tra-giao-co-lam.xls'],
        ['name' => 'Viêm Xương Khớp', 'file' => 'pp/vien-xuong-khop.xls'],
    ];

    //clear database.

    \App\Product::truncate();
    \App\City::truncate();
    \App\Delivery::truncate();

    //insert.

    foreach ($products as $product) {

        Excel::load(public_path($product['file']), function($reader) use ($product) {

            //check if product name exist in database.

            $proExist = \App\Product::where('name', $product['name'])->get();

            if ($proExist->count() == 0) {
                $pro = \App\Product::create([
                    'name' =>  $product['name'],
                    'slug' => Str::slug($product['name'])
                ]);
            } else {
                $pro = \App\Product::whereName($product['name'])->first();
            }
            $results = $reader->all();

            foreach ($results as $k => $row) {

                $ars = array_values($row->toArray());

                $town = $sdt = $title = $address = '';

                if (isset($ars[0])) {
                    $title = $ars[0];
                }

                if (isset($ars[1])) {
                    $address = $ars[1];
                }

                if (isset($ars[2])) {
                    $town = $ars[2];
                }

                if (isset($ars[3])) {
                    $sdt = $ars[3];
                }

                if ($town) {
                    $city = \App\City::where('name', $town)->get();
                    if ($city->count() == 0) {
                        $city = \App\City::create(['name' => $town]);
                    } else {
                        $city = $city->first();
                    }

                    \App\Delivery::updateOrCreate([
                        'product_id' =>  $pro->id,
                        'city_id' => $city->id,
                        'title' => $title
                    ],[
                        'product_id' =>  $pro->id,
                        'city_id' => $city->id,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $sdt,
                        'area' => ''
                    ]);
                }
            }
        });
    }

    echo "Done";

});

Route::post('importXls', 'DeliveriesController@import');

Route::get('/', function () {
    $settings = Setting::pluck('value', 'name')->all();
    $setting_meta_index = isset($settings['SEO_INDEX_TITLE']) ? $settings['SEO_INDEX_TITLE'] : 'Trang chủ | Tuệ Linh';
    $locale = (session('locale'))? session('locale') : 'vi';
    App::setLocale($locale);

    $page = 'homepage';

    $news = Post::where('status', true)->popular()->whereHas('modules', function($q){
        $q->where('slug', 'tin-tuc-trang-chu')->orderBy('order');
    })->limit(8)->get();

    $charities = Post::where('status', true)->popular()->whereHas('modules', function($q){
        $q->where('slug', 'tu-thien-trang-chu')->orderBy('order');
    })->limit(4)->get();

    $friends = \App\Friend::limit(10)->get();
    $awards = \App\Award::limit(10)->get();


    $products = Post::where('status', true)->popular()->whereHas('modules', function($q){
        $q->where('slug', 'san-pham-trang-chu')->orderBy('order');
    })->paginate(8);

    $forms = Post::where('status', true)->popular()->whereHas('modules', function($q){
        $q->where('slug', 'chuan-hoa-nguyen-lieu')->orderBy('order');
    })->limit(4)->get();


    return view('frontend.index', compact('page', 'news', 'products', 'forms', 'charities', 'friends', 'awards'))->with('meta_title', $setting_meta_index);
});

Route::get('language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect(Request::input('return'));
});

Route::get('home', function () {
    return redirect('/');
});

Auth::routes();

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::resource('admin/settings', 'SettingsController');
Route::resource('admin/categories', 'CategoriesController');
Route::resource('admin/posts', 'PostsController');
Route::resource('admin/deliveries', 'DeliveriesController');
Route::resource('admin/friends', 'FriendsController');
Route::resource('admin/awards', 'AwardsController');
Route::resource('admin/tags', 'TagsController');


Route::get('/admin', [
    'uses' => 'AdminController@index',
    'middleware' => ['auth', 'admin']
]);

Route::get('import-phan-phoi', 'MainController@import');
Route::get('replace', 'MainController@replace');
Route::post('saveContact', ['as' => 'saveContact', 'uses' => 'MainController@saveContact']);


Route::get('he-thong-phan-phoi/{product}/{city}', function($product_id, $city_id){
    $locale = (session('locale'))? session('locale') : 'vi';
    App::setLocale($locale);
    $page = 'page-solution';
    $deliveries = \App\Delivery::where('city_id', $city_id)
        ->where('product_id', $product_id)
        ->get();
    $city = \App\City::find($city_id);
    $product = \App\Product::find($product_id);

    return view('frontend.hethongphanphoi-chitiet', compact('page', 'deliveries', 'city', 'product'))->with('meta_title', 'Hệ thống phân phối | Tuệ Linh');
});

Route::get('tag/{value}', function($value){
    $locale = (session('locale'))? session('locale') : 'vi';
    App::setLocale($locale);
    $page = 'page-solution';
    $tag = \App\Tag::where('slug', $value)->first();
    $keyword = $tag->title;
    $posts = Post::whereHas('tags', function($q) use($tag){
        $q->where('id', $tag->id);
    })->popular()->paginate(9);
    return view('frontend.tag', compact('page', 'tag', 'posts', 'keyword'))->with('meta_title',  ucfirst($tag->title).' | Tuệ Linh');
});

Route::get('tim-kiem', 'MainController@search');

Route::get('/{value}', function ($value) {

    $locale = (session('locale'))? session('locale') : 'vi';
    App::setLocale($locale);
    $page = 'page-solution';
    if ($value == 'lien-he') {
        $departments = [
            'Marketing',
            'Hành Chính Nhân Sự',
            'Kế Toán',
            'Quản trị bán hàng'
        ];
        return view('frontend.lien-he', compact('page', 'departments'))->with('meta_title', 'Liên hệ | Tuệ Linh');
    } elseif ($value == 'tam-nhin-su-menh') {
        $category = \App\Category::where('slug', 'tam-nhin-su-menh')->first();

        $posts = Post::whereIn('category_id', $category->subCategories->pluck('id')->all())
            ->popular()
            ->latest('updated_at')
            ->paginate(15);


        return view('frontend.tin-tuc', compact('page', 'posts'))->with('meta_title', 'Tin tức | Tuệ Linh');

    } elseif ($value == 'he-thong-phan-phoi') {

        $products = \App\Product::pluck('name', 'id')->all();
        $cities = \App\City::pluck('name', 'id')->all();

        return view('frontend.he-thong-phan-phoi', compact('page', 'products', 'cities'))->with('meta_title', 'Hệ thống phân phối | Tuệ Linh');

    }  elseif (preg_match('/[a-z0-9\-]+-(\d+)/', $value, $matches)) {
        //posts
        $post = Post::find($matches[1]);


        $tuelinh = null;

        $post_tag = $post->tags->pluck('id')->all();

        $relatePosts = Post::whereHas('tags', function($q) use ($post_tag){
            $q->whereIn('id', $post_tag);
        })
            ->popular()
            ->where('id', '!=', $post->id)
            ->latest('updated_at')
            ->limit(5)
            ->get();

        $additionPost = null;

        if ($relatePosts->count() < 5) {
            $categoryLimit = 5- $relatePosts->count();
            $additionPost = Post::where('category_id', $post->category_id)->popular()
                ->where('id', '!=', $post->id)
                ->latest('updated_at')
                ->limit($categoryLimit)
                ->get();
        }


        $rightRelateds =  Post::where('category_id', $post->category_id)
            ->popular()
            ->where('id', '!=', $post->id)
            ->latest('updated_at')
            ->limit(6)
            ->get();

        $currentTuelinh = null;

        $banner = Setting::where('name', 'banner_chitiet')->first()->value;
        $meta_image = url('cache/256x256',  \App\ImageReverse::img($post->image));

        $meta_title = ($post->tieude) ? $post->tieude : $post->title.' | Tuệ Linh';

        return view('frontend.details', compact('meta_image','page', 'banner', 'post', 'relatePosts', 'tuelinh', 'currentTuelinh', 'rightRelateds', 'additionPost'))->with('meta_title', $meta_title);
    }  else {
        if (in_array($value, ['dai-cuong-ve-benh', 'thuoc-nam-tri-benh', 'tim-thuoc-theo-benh', 'san-pham'])) {
            //parent_categories.
            $category = \App\Category::where('slug', $value)->first();
            if ($category->slug == 'san-pham') {

                $posts = Post::where('category_id', $category->id)->popular()->latest('updated_at')->paginate(9);
                //get all tags
                $tags = \App\Tag::whereHas('posts', function($q) use ($category) {
                    $q->where('category_id', $category->id);
                })->get();
                $currentTuelinh = null;
                $tuelinh = Post::whereHas('category', function($q){
                    $q->where('slug', 'tue-linh');
                })->popular()->get();
                return view('frontend.san-pham', compact('page', 'category', 'posts', 'tags', 'currentTuelinh','tuelinh'))->with('meta_title', $category->translateOrNew($locale)->seo_title ? $category->seo_title : $category->title.' | Tuệ Linh');

            } elseif (in_array($category->slug, ['dai-cuong-ve-benh', 'thuoc-nam-tri-benh', 'tim-thuoc-theo-benh'])) {
                $posts = Post::where('category_id', $category->id)
                    ->popular()
                    ->orderBy('updated_at')
                    ->paginate(50);


                $list = Post::whereHas('modules', function($q) use ($category){
                    $q->where('slug', $category->slug)->orderBy('order');
                })->popular()->get();

                return view('frontend.tra-cuu', compact('page', 'category', 'posts', 'list'))->with('meta_title', $category->translateOrNew($locale)->seo_title ? $category->seo_title : $category->title.' | Tuệ Linh');

            }
        }
        else {
            //posts tuelinh menu

            $menuCategory = \App\Category::where('slug', 'gioi-thieu')->first();

            $tuelinh = Post::where('category_id', $menuCategory->id)->popular()->get();


            if ($value == 'lich-su-hinh-thanh') {
                $post = Post::find(19970);
            } elseif ($value == 'thanh-tuu') {
                $post = Post::find(19978);
            }

            $additionPost = null;

            $relatePosts = Post::where('category_id', $post->category_id)
                ->where('id', '!=', $post->id)
                ->popular()
                ->latest('updated_at')
                ->limit(6)
                ->get();

            $rightRelateds =  Post::whereHas('modules', function($q){
                $q->where('slug', 'tin-tuc-lien-quan')->orderBy('order');
            })->popular()->get();

            $currentTuelinh = $value;
            return view('frontend.details', compact('page', 'post', 'relatePosts', 'tuelinh', 'currentTuelinh', 'rightRelateds', 'additionPost'))->with('meta_title', 'Giới thiệu | Tuệ Linh');
        }

    }
});

Route::get('{value1}/{value2}', function($value1, $value2) {
    $locale = (session('locale'))? session('locale') : 'vi';
    App::setLocale($locale);
    $page = 'page-solution';
    $category = \App\Category::where('slug', $value2)->first();

    if ($category) {
        if (in_array($category->slug, ['me-va-be', 'y-hoc-co-truyen', 'khoe-va-dep'])) {
            $posts = Post::where('category_id', $category->id)
                ->popular()
                ->latest('updated_at')
                ->paginate(15);
            return view('frontend.tin-y-duoc', compact('page', 'category', 'posts'))->with('meta_title', $category->title.' | Tuệ Linh');

        } elseif (in_array($category->slug, ['tuyen-dung', 'hoat-dong-doanh-nghiep'])) {
            $posts = Post::where('category_id', $category->id)
                ->popular()
                ->latest('updated_at')
                ->paginate(15);
            return view('frontend.tin-tuc', compact('page', 'posts', 'category'))->with('meta_title', $category->translateOrNew($locale)->seo_title ? $category->seo_title : $category->title.' | Tuệ Linh');
        }
    }


});
