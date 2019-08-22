<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;

class BaseController extends Controller
{

    public function __construct()
    {
        App::setLocale('vi');
    }

    /**
     * Save images
     * @param $file
     * @param null $old
     * @return string
     */
    public function saveImage($file, $old = null)
    {
        $filename = md5(time()) . '.' . $file->getClientOriginalExtension();
        Image::make($file->getRealPath())->save(public_path('files/images/'. $filename));

        if ($old) {
            @unlink(public_path('files/images/' .$old));
        }
        return $filename;
    }
}
