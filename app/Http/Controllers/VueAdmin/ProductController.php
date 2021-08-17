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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::with('data')->paginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ProductResource::collection(Product::where('id', $id)->with('data')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
//process the request
            $product = Product::find($request->input('id'));
            $response = ['response' => $product, 'success' => true];
//            ProcessProductCreate::dispatch($product);

            $email = new ProductUpdate($product);
            Mail::to('dmitriybazhan79@gmail.com')->queue($email);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
