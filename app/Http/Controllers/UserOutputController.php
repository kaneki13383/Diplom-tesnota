<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserOutputController extends Controller
{
    public function all(){
        return User::all();
    }

    public function changeInfoUser(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');

        DB::table('users')->where('id',$id)->update([
            'name' => $name,
            'surname' => $surname,
            'email' => $email
        ]);
    }

    public function dataOrder(Request $request)
    {
        $id = $request->input('id');
        $adress = $request->input('adress');
        $number = $request->input('number');

        DB::table('users')->where('id', $id)->update([
            'adress' => $adress,
            'number' => $number
        ]);
    }
}
