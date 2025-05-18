<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promobanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\PromobannerStoreRequest;

class PromobannerController extends Controller
{
    public function index()
    {
        return view('admin.layouts.pages.promo.index');
    }

    public function store(PromobannerStoreRequest $request)
    {
        $promoBanner = $this->promoImage($request);
        Promobanner::create([
            'image' => $promoBanner,
            'is_active' => $request->is_active,
        ]);

        Toastr::success('Promo Banner added successfully.');
        return redirect()->back();
    }

    // Image edit and update code here
    private function promoImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = Image::read($request->file('image'));
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = public_path('uploads/promo_banners/');
            $image->save($destinationPath . $imageName);
            return 'uploads/promo_banners/' . $imageName;
        }
        return null;
    }
}
