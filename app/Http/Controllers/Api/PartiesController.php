<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parties;
use Illuminate\Http\Request;

class PartiesController extends Controller
{
    public function list()
    {
        return response()->json(Parties::all());
    }
    public function add(Request $request)
    {
        $parties = new Parties();
        $parties->name = $request->name;
        $parties->phone = $request->phone;
        $parties->address = $request->address;
        $parties->save();
        return response()->json(['sucess' => 'parties add sucessfully'], 200);
    }
    public function edit(Request $request)
    {
        $parties = Parties::where('id', $request->id)->first();
        // return response()->json(['error' => 'parties not found'], 404);
        // if (!$parties) {
        // }
        $parties->name = $request->name;
        $parties->phone = $request->phone;
        $parties->address = $request->address;
        $parties->save();
        return response()->json($parties);
    }
    public function del(Request $request)
    {
        $id = $request->id;
        $parties = Parties::where('id', $id)->first();
        return response()->json(['error' => 'parties not found'], 404);
        if (!$parties) {
        }
        $parties->delete();
    }
    public function show(Request $request)
    {
        $id = $request->id;
        $parties = Parties::find($id);
        if (!$parties) {
            return response()->json(['error' => 'parties not found'], 404);
        }
        return response()->json($parties);
    }
}
