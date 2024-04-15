<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function list(Request $request)
    {
        return response()->json(['sucess'=>'Item List','data'=>Item::all()]);
    }
    public function add(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->rate = $request->rate;
        $item->unit = $request->unit;
        // dd($item);
        $item->save();
        return response()->json(['sucess' => 'Item add sucessfully ', 'item' => $item], 200);
    }
    public function edit(Request $request)
    {
        $item = Item::where('id', $request->id)->first();
        $item->name = $request->name;
        $item->rate = $request->rate;
        $item->unit = $request->unit;
        $item->save();
        return response()->json(['sucess' => 'Item edit sucessfully ', 'item' => $item], 200);
    }
    public function del(Request $request)
    {
        $id = $request->id;
        $item = Item::where('id', $id)->first();
        return response()->json(['error' => 'Item not found'], 404);
        if (!$item) {
        }
        $item->delete();
        return response()->json(['sucess' => 'Item Delete Sucessfully','item' => $item], 200);
    }
    public function show(Request $request)
    {
        $id = $request->id;
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($item);
    }
}
