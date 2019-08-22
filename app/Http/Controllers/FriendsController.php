<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\FriendRequest;
use App\Friend;

class FriendsController extends BaseController {

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $friends = Friend::latest('updated_at')->paginate(10);
        return view('admin.friend.index', compact('friends'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.friend.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return Response
     */
    public function store(FriendRequest $request)
    {
        $data = $request->all();
        $data['image'] = ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '';
        Friend::create($data);

        Friend::create([
            'image' => ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '',
            'vi' => ['title' => $data['title_vi'], 'desc' => $data['desc_vi']],
            'en' => ['title' => $data['title_en'], 'desc' => $data['desc_en']],
            'fr' => ['title' => $data['title_fr'], 'desc' => $data['desc_fr']]
        ]);

        flash('Thêm mới hội đồng thành công!', 'success');
        return redirect('admin/friends');
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
        $friend = Friend::with('translations')->find($id);
        return view('admin.friend.form', compact('friend'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param QuestionRequest $request
     * @return Response
     */
    public function update($id, FriendRequest $request)
    {
        $friend =  Friend::findOrFail($id);
        $data = $request->all();


        foreach (['title', 'desc'] as $field) {
            foreach (['vi', 'en', 'fr'] as $lang) {
                $friend->translateOrNew($lang)->$field = !empty($data[$field.'_'.$lang])? $data[$field.'_'.$lang] : '';
            }
        }

        if ($request->file('image') && $request->file('image')->isValid()) {
            $friend->image = $this->saveImage($request->file('image'), $friend->image);
        }

        $friend->save();
        flash('Sửa thành viên hội đồng thành công!', 'success');
        return redirect('admin/friends');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $friend = Friend::findOrFail($id);
        if (file_exists(public_path('files/images/' . $friend->image))) {
            @unlink(public_path('files/images/' . $friend->image));
        }
        $friend->delete();

        flash('Xoá thành viên hội đồng thành công!');
        return redirect('admin/friends');
    }
}
