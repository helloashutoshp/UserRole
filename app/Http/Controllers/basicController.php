<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Language;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hashids\Hashids;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class basicController extends Controller
{
    public function create()
    {
        $language = Language::all();
        return view('basic.register', ['language' => $language]);
    }

    public function store(Request $req)
    {
        // dd($req->all());
        $validate = Validator::make($req->all(), [
            'fname' => 'required|regex:/^[a-zA-Z]+$/u',
            'lname' => 'required|regex:/^[a-zA-Z]+$/u',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'age' => 'required|integer|between:20,50',
            'gender' => 'required',
            'password' => 'required',
            'cpassword' => 'required|same:password',
            'language' => 'required',
            // 'images' => 'required|array', // Validate that 'images' is an array
            // 'images.*' => 'mimes:jpg,jpeg,png|max:2048', // Validate each file in the array
        ], [
            'fname.regex' => 'Please enter a valid name',
            'language.required' => 'Please select at least one language.',
            'phone.digits' => "please enter a valid phone number",
            'age.between' => "Age must be in between 20 to 50",
            'cpassword.same' => "password doesn't match",
            'password.reqiured' => "Please enter a password"
            // 'images.required' => 'An image file is required.',
            // 'images.mimes' => 'The image must be in JPG, JPEG, or PNG format.',
            // 'images.max' => 'The image size must not exceed 2MB.',
        ]);
        if ($validate->passes()) {
            // $hashids = new Hashids();
            // $pass =  $hashids->encode($req->password);
            // dd($req->password);
            $store = new Test();
            $store->fname = $req->fname;
            $store->lname = $req->lname;
            $store->email = $req->email;
            $store->age = $req->age;
            $store->phone = $req->phone;
            $store->password = Hash::make($req->password);
            $store->gender = $req->gender;
            $store->description = !empty($req->language) ? implode(',', $req->language) : '';
            $store->save();

            if ($req->hasFile('images')) {
                $images = $req->images;
                foreach ($images as $img) {
                    $imgExt = $img->getClientOriginalExtension();
                    $imgName = time() . uniqid() . '.' . $imgExt;
                    $img->move(public_path() . '/basic', $imgName);
                    $imgTable = new Image();
                    $imgTable->name = $imgName;
                    $imgTable->test_id = $store->id;
                    $imgTable->save();
                }
            }

            return response()->json([
                'status' => true,
                'message' => "validation done"
            ]);
        } else {
            // dd($validate->errors());
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
    }
    public function show()
    {
        $data = Test::with('image')->latest()->paginate(5);
        foreach ($data as $dat) {
            $languages = explode(',', $dat->description);
            $dat->description = Language::whereIn('id', $languages)->pluck('name');
        }
        // dd($data);
        return view('basic.list', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = Test::find($id);
        $language = Language::all();
        // foreach ($data as $dat) {
        $languages = explode(',', $data->description);
        $data->description = Language::whereIn('id', $languages)->pluck('id');
        // }
        $image = Image::where('test_id', $id)->get();
        // dd($image);
        return view('basic.edit', ['data' => $data, 'image' => $image, 'language' => $language]);
    }


    public function update(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'fname' => 'required|regex:/^[a-zA-Z]+$/u',
            'lname' => 'required|regex:/^[a-zA-Z]+$/u',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'age' => 'required|integer|between:20,50',
            'gender' => 'required',
            'language' => 'required',
            // 'images' => 'required|array', // Validate that 'images' is an array
            // 'images.*' => 'mimes:jpg,jpeg,png|max:2048', // Validate each file in the array
        ], [
            'fname.regex' => 'Please enter a valid name',
            'language.required' => 'Please select at least one language.',
            'phone.digits' => "please enter a valid phone number",
            'age.between' => "Age must be in between 20 to 50",
            'cpassword.same' => "password doesn't match",
            // 'images.required' => 'An image file is required.',
            // 'images.mimes' => 'The image must be in JPG, JPEG, or PNG format.',
            // 'images.max' => 'The image size must not exceed 2MB.',
        ]);
        if ($validate->passes()) {
            // $hashids = new Hashids();
            // $pass =  $hashids->encode($req->password);
            // dd($req->password);
            $store = Test::find($req->id);
            $store->fname = $req->fname;
            $store->lname = $req->lname;
            $store->email = $req->email;
            $store->age = $req->age;
            $store->phone = $req->phone;
            $store->password = Hash::make($req->password);
            $store->gender = $req->gender;
            $store->description = !empty($req->language) ? implode(',', $req->language) : '';
            $store->update();

            if ($req->hasFile('images')) {
                $images = $req->images;
                // dd($images);
                // $pathname = $images->pathname();
                // dd($pathname);
                foreach ($images as $img) {
                    $imgExt = $img->getClientOriginalExtension();
                    $imgName = time() . uniqid() . '.' . $imgExt;
                    $img->move(public_path() . '/basic', $imgName);
                    $imgTable = new Image();
                    $imgTable->name = $imgName;
                    // dd($imgName);
                    $imgTable->test_id = $req->id;
                    $imgTable->save();
                }
            }

            return response()->json([
                'status' => true,
                'message' => "validation done"
            ]);
        } else {
            // dd($validate->errors());
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
    }

    public function delete($id)
    {
        $record = Test::find($id);
        $image = Image::where('test_id', $id)->get();
        foreach ($image as $img) {
            $name = $img->name;
            // dd($name);
            File::delete(public_path('basic/' . $name));
            // $img->delete();
        }
        $record->delete();
        return response()->json([
            'status' => true,
            'message' => "Deleted successfully"
        ]);
    }

    public function deleteImg(Request $request)
    {
        $id = $request->id;
        // dd($id);
        $image = Image::find($id);
        File::delete(public_path('basic/' . $image->name));
        $image->delete();
        return response()->json([
            'status' => true,
            'message' => 'Image deleted'
        ]);
    }
}
