<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function showUsers()
    {
        $data['users'] = User::all();
        $data['page'] = 'Users';
        return view('admin.users.users', $data);
    }


}
