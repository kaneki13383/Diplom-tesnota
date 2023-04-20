<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Image;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function allMenu()
    {
        $pagination = DB::table('menus')->paginate(6);
        $items = $pagination->items();
        $products = [];
        foreach ($items as $item) {
            $products[] = Menu::find($item->id);
        }
        return response()->json([
            'message' => 'Для Каталога',
            'content' => $pagination,
            'products' => MenuResource::collection($products)
        ]);
    }

    public function allAdminMenu()
    {
        return MenuResource::collection(Menu::all());
    }

    public function createProduct(Request $request)
    {
        Menu::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discription' => $request->input('discription'),
            'type' => $request->input('type'),
        ]);

        $menu = Menu::get()->last();

        $images = $request->file;

        foreach ($images as $image) {
            Image::create([
                'id_menus' => $menu->id,
                'img' => '../menu/' . $image->getClientOriginalName()
            ]);
            $image->move(public_path('menu'), $image->getClientOriginalName());
        }
    }

    public function delete($id)
    {
        Menu::where('id', $id)->delete();
        Image::where('id_menus', $id)->delete();
    }

    public function find($id)
    {
        return MenuResource::collection(Menu::where('id', $id)->get());
    }

    public function edit(Request $request)
    {
        Menu::where('id', $request->input('id_product'))->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discription' => $request->input('discription'),
            'type' => $request->input('type')
        ]);

        $images = $request->file;

        foreach ($images as $image) {
            Image::create([
                'id_menus' => $request->input('id_product'),
                'img' => '../menu/' . $image->getClientOriginalName()
            ]);
            $image->move(public_path('menu'), $image->getClientOriginalName());
        }
    }
}
