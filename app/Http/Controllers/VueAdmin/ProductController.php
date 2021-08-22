<?php

namespace App\Http\Controllers\VueAdmin;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessProductCreate;
use App\Mail\ProductUpdate;
use App\Models\Product;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with('data')->paginate(25));

// Пример получения ProductData в Api только для одной локали
//        return ProductResource::collection(
//            Product::with(['data' => function($query){
//                return $query->where('lang', app()->getLocale());
//            }])->paginate(25)
//        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return ProductResource::collection(Product::where('id', $id)->with('data')->get());
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'vendor_code' => 'required|alpha_dash|max:25',
            'search_string' => 'required|alpha_dash|max:200',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = ['response' => 'NOT GOOD', 'success' => false, 'errors' => $errors];
        } else {
            Product::where('id', $request->input('id'))
                ->update([
                    'vendor_code' => $request->input('vendor_code'),
                    'search_string' => $request->input('search_string'),
                ]);

// Очередь из emails через Jobs
//            ProcessProductCreate::dispatch($request->input('id'));


// Очередь из emails через фасад Mail
//            $email = new ProductUpdate($request->input('id'));
//            Mail::to('dmitriybazhan79@gmail.com')->queue($email);


            $response = ['response' => $request->all(), 'success' => true];
        }
        return $response;
    }

    public function destroy($id)
    {
        //
    }
}
