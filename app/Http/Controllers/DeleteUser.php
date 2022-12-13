<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteUser extends Controller
{
    public function delete($id){
        User::find($id)->delete();
    }
}
