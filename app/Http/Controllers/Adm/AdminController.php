<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUsers(){
        return view('admin.users');
    }

    public function showBooks(){
        return view('admin.books');
    }
    public function showComments(){
        return view('admin.comments');
    }
}
