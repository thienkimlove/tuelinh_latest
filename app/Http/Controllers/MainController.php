<?php

namespace App\Http\Controllers;
use App;
use App\City;
use App\Contact;
use App\Delivery;
use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use App\Post;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    /**
     * Them tinh thanh hay san pham vao cuoi cung cua mang? sau do run
     * tuelinh.vn/import-phan-phoi
     */
    public function import()
    {

        $provinces = array(
            'An Giang- An Phú', 'An Giang- Châu Phú',
            'An Giang- Chợ Mới', 'An Giang- Long Xuyên A', 
	        'An Giang- Long Xuyên B', 'An Giang- Phú Tân', 'An Giang- Tân Châu',
            'An Giang- Thoại Sơn', 'An Giang- Tri Tôn', 'Bà Rịa - Vũng Tàu',
            'Bà Rịa - Châu Đức', 'Bà Rịa - Đất Đỏ', 
	        'Bà Rịa - Tân Thành', 'Bà Rịa - Xuyên Mộc',
            'Bạc Liêu', 'Bảo Lộc - Lâm Đồng', 'Bắc Giang - Hiệp Hòa', 
	        'Bắc Giang - Lạng Giang', 'Bắc Giang - Tân Yên', 
	        'Bắc Giang - Thành phố', 'Bắc Giang - Việt Yên',  'Bắc Giang - Yên Dũng',
            'Bắc Ninh - Lương Tài', 'Bắc Ninh - Quế Võ',
	        'Bắc Ninh - Tiên Du', 'Bắc Ninh - Từ Sơn',
	        'Bắc Ninh - Thành phố', 'Bắc Ninh - Thuận Thành',
	        'Bến Tre', 'Bình Dương - KV1', 
	        'Bình Dương - KV2', 'Bình Dương - Bến Cát',
            'Bình Dương - Dĩ An', 'Bình Dương - Phú Giáo', 
	        'Bình Dương - Thuận An', 'Bình Định', 
	        'Bình Định III', 'Bình Phước - Bình Long', 'Bình Phước - Chơn Thành',
            'Bình Phước - Đồng Xoài', 'Bình Phước - Phước Long', 'Bình Thuận',
	        'Cà Mau', 'Cao Bằng', 'Cần Thơ - KV1',
            'Cần Thơ - KV2', 'Cần Thơ- Cờ Đỏ',
	        'Cần Thơ- Thốt Nốt',
	        'Châu Đốc - An Giang', 'Đà Lạt - Lâm Đồng',
            'Đà Nẵng - KV1', 'Đà Nẵng - KV3', 'Đà Nẵng - Hòa Vang',
            'Đà Nẵng - Hội An', 'Đắc Lắc - KV1', 'Đắc Lắc - KV2',
            'Đắc Lắc - Ea Kar', 'Đắc Lắc - Krong Păk', 'Điện Biên',
            'Đồng Nai - Biên Hòa 1', 'Đồng Nai - Biên Hòa 2', 
	        'Đồng Nai - Long Khánh', 'Đồng Nai - Long Thành',
	        'Đồng Nai - Thống Nhất', 
            'Đồng Nai - Trảng Bom', 'Đồng Nai - Vĩnh Cửu', 'Đồng Nai - Xuân Lộc',
            'Đồng Tháp', 'Gia Lai', 'Hà Giang',
	        'Hà Nam', 'Hà Nội', 'Hồ chí minh',
	        'Hà Nội - Gia Lâm', 'Hà Nội - Phú Xuyên',
            'Hà Nội - Ba Vì', 'Hà Nội - Chương Mỹ', 'Hà Nội - Đan Phượng ',
	        'Hà Nội - Đông Anh', 'Hà Nội - Phúc Thọ', 'Hà Nội - Quốc Oai',
            'Hà Nội - Sơn Tây', 'Hà Nội - Thạch Thất', 'Hà Nội - Thanh Oai',
	        'Hà Nội - Thường Tín', 'Hà Tĩnh', 'Hải Phòng - KV1',
	        'Hậu Giang', 'Hoà Bình', 'Huế',
	        'Kiên Giang', 'Kiên Giang - Tân Hiệp', 
	        'Kiên Giang - Hòn Đất',
	        'Kontum', 'Khánh Hòa',
	        'Khánh Hòa - Cam Lâm', 'Khánh Hòa - Cam Ranh',
	        'Khánh Hòa - Ninh Hòa',
            'Khánh Hòa - Nha Trang', 
	        'Lai Châu', 'Lạng Sơn', 'Lào Cai',
	        'Long An', 'Nam Định',
	        'Nam Định - Hải Hậu', 'Nam Định - Trực Ninh',
	        'Ninh Bình',
            'Ninh Bình - Kim Sơn', 'Ninh Bình - Nho Quan', 'Ninh Bình - Tam Điệp',
            'Ninh Bình - Yên Khánh', 'Ninh Thuận', 'Nghệ An - Cửa Lò',
            'Nghệ An - Diễn Châu', 'Nghệ An - KV1',
		    'Nghệ An - KV2', 'Nghệ An - Nghi Lộc',
		    'Nghệ An - Quỳnh Lưu', 'Nghệ An - Yên Thành',
			'Phú Thọ -  Thanh Sơn', 'Phú Thọ - Cẩm Khê',
			'Phú Thọ - Đoan Hùng', 'Phú Thọ - Lâm Thao',
			'Phú Thọ - Phù Ninh', 'Phú Thọ - Thanh Ba',
			'Phú Thọ - Thanh Thủy', 'Phú Thọ - Việt Trì',
			'Phú Yên', 'Quảng Bình',
			'Quảng Nam', 'Quảng Ngãi',
			'Quảng Trị', 'Sóc Trăng',
			'Sơn La', 'Tây Ninh - Bến Cầu',
			'Tây Ninh - Gò Dầu', 'Tây Ninh - Tân Châu',
			'Tây Ninh - Thành Phố', 'Tây Ninh - Trảng Bàng',
			'Tiền Giang', 'Hải Dương',
			'Hưng Yên', 'Quảng Ning',
			'TP HCM - Củ Chi', 'TP HCM - Hóc Môn',
			'Tuyên Quang', 'Thái Bình - Đông Hưng',
			'Thái Bình - Hưng Hà', 'Thái Bình - Kiến Xương',
			'Thái Bình - Quỳnh Phụ', 'Thái Bình - Tiền Hải',
			'Thái Bình - Thái Thụy', 'Thái Bình - Thành Phố',
			'Thái Nguyên - KV1', 'Thái Nguyên - KV2',
			'Thái Nguyên - Đại Từ', 'Thái Nguyên - Phổ Yên',
			'Thái Nguyên - Phú Lương', 'Thái Nguyên - Sông Công',
			'Thanh Hóa - Bỉm Sơn', 'Thanh Hóa - Đông Sơn',
			'Thanh Hóa - Hậu Lộc', 'Thanh Hóa - KV1',
			'Thanh Hóa - KV2', 'Thanh Hóa - Nga Sơn',
			'Thanh Hóa - Ngọc Lặc', 'Thanh Hóa - Như Thanh',
			'Thanh Hóa - Quảng Xương', 'Thanh Hóa - Sầm Sơn',
			'Thanh Hóa - Tĩnh Gia', 'Thanh Hóa - Thiệu Hóa',
			'Thanh Hóa - Thọ Xuân', 'Thanh Hóa - Triệu Sơn',
			'Thanh Hóa - Vĩnh Lộc', 'Thanh Hóa - Yên Định',
			'Thanh Hóa - Nông Cống', 'Trà Vinh',
			'Vĩnh Long', 'Vĩnh Phúc - Lập Thạch',
			'Vĩnh Phúc - Phúc Yên', 'Vĩnh Phúc - Tam Dương',
			'Vĩnh Phúc - Tam Đảo', 'Vĩnh Phúc - TP.Vĩnh Yên',
			'Vĩnh Phúc - Vĩnh Tường', 'Vĩnh Phúc - Yên Lạc',
			'Vũng Tàu ', 'Vũng Tàu - Long Điền',
			'Yên Bái',
        );

        DB::statement('TRUNCATE table cities');
        foreach ($provinces as $pro) {
            DB::table('cities')->insert([
                'name' => $pro
            ]);
        }

        $products = [
		'An tim Tuệ Linh',
	    'Cà gai leo',
		'Chay Tuệ Linh',
	    'Dầu gấc',
		'Dầu tỏi Tuệ Linh',
        'Dưỡng thận Tuệ Linh',
        'Trà Giảo Cổ Lam',
	    'Giảo cổ lam viên 60',
        'Trà Giải Độc Gan',
	    'Giải độc gan viên 60',
	    'Lycoskin',
        'Lycoeye',
	    'Tiền liệt vương',
	    'Viên xương khớp',
        ];

        DB::statement('TRUNCATE table products');

        foreach ($products as $pro) {
            DB::table('products')->insert([
                'name' => $pro
            ]);
        }

    }


    /**
     * save contact form.
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveContact(ContactRequest $request)
    {
        Contact::create($request->all());
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private function _fillPosts()
    {
        $data = [];
        $posts = DB::connection('mysql2')->select('select * from tu81_posts where post_type="posts"');
        foreach ($posts as $post) {
            $data['title'] = $post->post_title;
            $data['content'] = $post->post_content;
            $data['display_id'] = $post->ID;
            $data['created_at'] = $post->post_date;
            $data['updated_at'] = $post->post_modified;

            $avatar = DB::connection('mysql2')->select('select * from tu81_posts where post_type="attachment" and ID="' . $post->ID . '" limit 1');
            if ($avatar) {
                $data['image'] = $avatar->guid;
            }
            $meta = DB::connection('mysql2')->select('select * from tu81_postmeta where post_id="' . $post->ID . '"');
            foreach ($meta as $tag) {
                if ($tag->meta_key == '_yoast_wpseo_metakeywords') {
                    $data['keyword'] = $tag->meta_value;
                }
            }
            $term = DB::connection('mysql2')->select('SELECT t2.* FROM  tu81_term_relationships t1, tu81_term_taxonomy t2 WHERE t1.term_taxonomy_id = t2.term_taxonomy_id AND  t1.object_id = "' . $post->ID . '" AND t2.taxonomy = "category" ')->first();
            $data['category_id'] = $term->id;
        }
    }

    private function fillCategory()
    {
        $data = [];
        $query = "SELECT t1 . * , t2.parent
                    FROM  tu81_terms t1, tu81_term_taxonomy t2
                    WHERE t1.term_id = t2.term_id
                    AND taxonomy =  'category'";
        $categories = DB::connection('mysql2')->select($query);
        foreach ($categories as $cate) {

        }
    }

    public function index()
    {


    }

    public function search(Request $request)
    {
        $locale = (session('locale'))? session('locale') : 'vi';
        App::setLocale($locale);
        $keyword = $request->input('q');
        $page = 'page-solution';
        $posts = Post::whereHas('translations', function ($query) use ($keyword) {
            $query->where('locale', 'vi')
                ->where('title', 'LIKE', '%'.$keyword.'%');
        })
            ->latest('updated_at')
            ->paginate(9);
        return view('frontend.tag', compact('page', 'posts', 'keyword'))->with('meta_title',  ucfirst($keyword).' | Tuệ Linh');
    }

}
