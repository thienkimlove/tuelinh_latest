<?php

namespace App\Http\Controllers;

use App\City;
use App\Delivery;
use App\Http\Requests;
use App\Http\Requests\DeliveryRequest;
use App\Product;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PHPExcel_Settings;

class DeliveriesController extends BaseController
{
    protected $province, $area, $product;
    public function __construct()
    {
        $areas = ['Miền Bắc', 'Miền Trung', 'Miền Nam'];
        $this->area = [];
        $this->province = City::pluck('name', 'id');
        $this->product = Product::pluck('name', 'id');
        foreach ($areas as $area) {
            $this->area[$area] = $area;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $deliveries = Delivery::paginate(20);
        return view('admin.delivery.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cities = $this->province;
        $products = $this->product;
        $areas = $this->area;
        return view('admin.delivery.form', compact('cities', 'areas', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Response
     */
    public function store(DeliveryRequest $request)
    {
        $data = $request->all();
        Delivery::create($data);
        flash(trans('common.delivery_create_success'), 'success');
        return redirect('admin/deliveries');
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
        $cities = $this->province;
        $areas = $this->area;
        $products = $this->product;
        $delivery = Delivery::find($id);
        return view('admin.delivery.form', compact('delivery', 'cities', 'areas', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CategoryRequest $request
     * @return Response
     */
    public function update($id, DeliveryRequest $request)
    {

        $data = $request->all();
        $delivery = Delivery::find($id);
        $delivery->update($data);

        flash(trans('common.delivery_edit_success'), 'success');
        return redirect('admin/deliveries');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $delivery = Delivery::find($id);
        $delivery->delete();
        flash(trans('common.delivery_delete_success'), 'success');
        return redirect('admin/deliveries');
    }

    public function import(Request $request)
    {
        $product_name = $request->input('name');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        if (file_exists(public_path('xls/'.$request->input('file_path')))) {
            Excel::load(public_path('xls/'.$request->input('file_path')), function($reader) use ($product_name) {

                //check if product name exist in database.

                $proExist = Product::where('name', $product_name)->get();

                if ($proExist->count() == 0) {
                    $pro = Product::create([
                        'name' =>  $product_name,
                        'slug' => Str::slug($product_name)
                    ]);
                } else {
                    $pro = Product::whereName($product_name)->first();
                }
                $results = $reader->all();

                foreach ($results as $row) {
                    $town = null;
                    if ($row->tinh) {
                        $town = $row->tinh;
                    }
                    if ($row->thanh_pho) {
                        $town = $row->thanh_pho;
                    }
                    if ($row->khu_vuc_tinh) {
                        $town = $row->khu_vuc_tinh;
                    }

                    if ($town) {
                        $city = City::where('name', $town)->get();
                        if ($city->count() == 0) {
                            $city = City::create(['name' => $town]);
                        } else {
                            $city = $city->first();
                        }

                        $sdt = '';
                        if ($row->sdt) {
                            $sdt = $row->sdt;
                        }
                        if ($row->so_dien_thoai) {
                            $sdt = $row->so_dien_thoai;
                        }
                        $title = '';
                        if ($row->ten_nha_thuoc) {
                            $title = $row->ten_nha_thuoc;
                        }
                        if ($row->nha_thuoc) {
                            $title = $row->nha_thuoc;
                        }

                        if ($title) {
                            Delivery::updateOrCreate([
                                'product_id' =>  $pro->id,
                                'city_id' => $city->id,
                                'title' => $title
                            ],[
                                'product_id' =>  $pro->id,
                                'city_id' => $city->id,
                                'title' => $title,
                                'address' => ($row->dia_chi)? $row->dia_chi : '',
                                'phone' => $sdt,
                                'area' => ''
                            ]);
                        }

                    }
                }

            });
            flash('Success Imported', 'success');
        } else {
            flash('File not exist!', 'success');
        }


        return redirect('admin/deliveries');
    }
}
