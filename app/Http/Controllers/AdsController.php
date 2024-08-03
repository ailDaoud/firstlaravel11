<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Img;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;

class AdsController extends Controller
{
    public function index()
    {
        $img = Img::with('ads')->get();
        $ads = Ads::with('images')->get();
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
        if ($request->isMethod('post')) {
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
                        $filePath = $file->storeAs('ads_images', $filename, 'public');
                        $ads->images()->create([
                            'ad_id' => $ads->id,
                            'image_path' => $filePath
                        ]);
                    }

                    $data = Ads::all();

                    return view('home', compact('data'));
                } else {
                    return view('add_post');
                }
            } catch (Exception $e) {
                return response()->json([
                    'success' => 0,
                    'result' => null,
                    'message' => $e->getMessage()
                ], 200);
            }
        }
        return view('add_post');
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


/*
 <section class="auto-slider">
                <div id="slider">
                    <figure>
                        @foreach ($items->images as $img)
                            <img class="responsive" src= "{{ Storage::url($img->image_path) }}" alt="">
                        @endforeach
                    </figure>
                    <div class="indicator"></div>
                </div>
            </section>*/
