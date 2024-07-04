<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Img;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\View;

class AdsController extends Controller
{
    public function index()
    {
        $img = Img::with('ads')->get();
        $ads = Ads::with('images')->get();
        $data = Ads::all();
        try {
            if ($ads) {
                return response()->json([
                    'success' => 1,
                    'result' => $ads,
                    'message' => "",
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' =>  __('res.a_message'),
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }

    public function store(Request $request)
{
    if($request->isMethod('post')){
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'describtion' => 'required|string',
        'amount' => 'required|integer',
        'price' => 'required|integer',
        'note' => 'required|string',
        'image_path' => 'required|array',
        'image_path.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => 0,
            'result' => null,
            'message' => $validator->errors(),
        ], 200);
    }

    try {
        $user = User::findOrFail($request->user_id);
        $ads = $user->ads()->create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'describtion' => $request->describtion,
            'amount' => $request->amount,
            'price' => $request->price,
            'note' => $request->note,
        ]);

        if ($request->hasFile('image_path')) {
            foreach ($request->file('image_path') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
               // $file->move(public_path('ads_images'), $filename);
                $file->store('image','public');
              // $file->store('image');ss
                $ads->images()->create([
                    'ad_id' => $ads->id,
                    'image_path' => 'ads_images/' . $filename
                ]);
            }

          /*  return response()->json([
                'success' => 1,
                'result' => __('res.a_store'),
                'message' => ""
            ], 200);*/
            $data=Ads::all();
            return View('home',compact('data'));
        } else {
           /* return response()->json([
                'success' => 0,
                'result' => null,
                'message' => 'No images uploaded.'
            ], 200);*/
            return View('add_post');
        }
    } catch (Exception $e) {
        return response()->json([
            'success' => 0,
            'result' => null,
            'message' => $e->getMessage()
        ], 200);
    }
}
else{
    return View('add_post');
}
}
    public function show($id)
    {
        $ads = Ads::findOrFail($id)->with('images')->get();
        if (!$ads) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('res.a_show')
            ], 200);
        } else {
            return response()->json([
                'success' => 1,
                'result' => $ads,
                'message' => ''
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'describtion' => 'required|string',
            'amount' => 'required|integer',
            'price' => 'required|integer',
            'note' => 'required|string',
            'img_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $validator->errors(),
            ], 200);
        }
        try {

            $ads = Ads::findOrFail($id);
            $imge = new Img();
            if ($ads) {
                if ($request->name) {
                    $ads->name = $request->name;
                }
                if ($request->describtion) {
                    $ads->describtion = $request->describtion;
                }
                if ($request->amount) {
                    $ads->amount = $request->amount;
                }
                if ($request->price) {
                    $ads->price = $request->price;
                }
                if ($request->note) {
                    $ads->note = $request->note;
                }
                if ($request->hasFile('img_id')) {
                    $imgs = $request->file('img_id');
                    foreach ($imgs as $img) {
                        //  $i=$request->img_id;
                        $img_url = time() . '.' . $img->getClientOriginalName();
                        $img->store('ads_images');
                        $img->save();
                    }
                }
                $ads->save();
                return response()->json([
                    'success' => 1,
                    'result' => $ads,
                    'message' => __('res.a_update'),
                ], 200);
            } else {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => __('res.show'),
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $e
            ], 200);
        }
    }

    public function destroy($id)
    {
        $ads = Ads::findOrFail($id);
        if ($ads) {
            $ads->images()->delete();
            $ads->delete();
            return response()->json([
                'success' => 1,
                'result' => null,
                'message' => __('res.a_delete')
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => __('res.a_show')
            ], 200);
        }
    }
}
