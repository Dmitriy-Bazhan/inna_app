<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParsingController extends Controller
{
    public function index() {
        $data['page'] = 'Parser';
        return view('admin.parsing.parsing', $data);
    }
}
