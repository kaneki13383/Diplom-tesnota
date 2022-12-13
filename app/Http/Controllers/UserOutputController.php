<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserOutputController extends Controller
{
    public function all(){
        return User::all();
    }
}
