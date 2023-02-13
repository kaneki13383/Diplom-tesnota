<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function allMenu(){
        return MenuResource::collection(Menu::all());
    }

    public function createProduct(Request $request)
    {
        $fileName = $request->file->getClientOriginalName();  
     
        $request->file->move(public_path('menu'), $fileName);

        Menu::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discription' => $request->input('discription'),
            'img' => '../menu/'.$fileName,
            'type' => $request->input('type'),
        ]);
    }
    
    public function delete($id)
    {
        Menu::where('id', $id)->delete();
    }

    public function find($id)
    {
        return Menu::find($id);
    }

    public function edit(Request $request)
    {
        Menu::where('id', $request->input('id_product'))->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discription' => $request->input('discription'),
            'type' => $request->input('type'),
        ]);
    }
}