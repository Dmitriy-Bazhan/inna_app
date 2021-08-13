<?php

namespace App\Http\Controllers\VueAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $data['page'] = 'Users';
        return view('admin.layouts.vue-admin-layout', $data);
    }
}
