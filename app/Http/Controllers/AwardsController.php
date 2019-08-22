<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AwardRequest;
use App\Award;

class AwardsController extends BaseController {

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
        $awards = Award::latest('updated_at')->paginate(10);
        return view('admin.award.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.award.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionRequest $request
     * @return Response
     */
    public function store(AwardRequest $request)
    {
        $data = $request->all();
        $data['image'] = ($request->file('image') && $request->file('image')->isValid()) ? $this->saveImage($request->file('image')) : '';
        Award::create($data);
        flash('Thêm mới giải thưởng thành công!', 'success');
        return redirect('admin/awards');
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
        $award = Award::findOrFail($id);
        return view('admin.award.form', compact('award'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param QuestionRequest $request
     * @return Response
     */
    public function update($id, AwardRequest $request)
    {
        $award =  Award::findOrFail($id);
        $data = $request->all();
        if ($request->file('image') && $request->file('image')->isValid()) {
            $data['image'] = $this->saveImage($request->file('image'), $award->image);
        }
        $award->update($data);
        flash('Sửa giải thưởng thành công!', 'success');
        return redirect('admin/awards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $award = Award::findOrFail($id);
        if (file_exists(public_path('files/images/' . $award->image))) {
            @unlink(public_path('files/images/' . $award->image));
        }
        $award->delete();

        flash('Xoá giải thưởng thành công!');
        return redirect('admin/awards');
    }
}
