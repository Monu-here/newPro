<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Ledger;
use App\Models\User;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function list(Request $request)
    {
        return response()->json(['success' => 'Ledger list', 'data' => Ledger::all()]);
    }
    public function add(Request $request)
    {
        $ledger = new Ledger();
        $ledger->title = $request->title;
        $ledger->amount = $request->amount;
        $ledger->item_id = $request->item_id;
        $ledger->rate = $request->rate;
        $ledger->user_id = $request->user_id;
        $ledger->decive_id = $request->decive_id;
        $ledger->remote_id = $request->remote_id;
        $ledger->type = $request->type;   // 1 = CR , 2 = DR
        $users = User::all();
        $items = Item::all();

        return response()->json([
            'users' => $users,
            'items' => $items
        ]);
        $ledger->save();
        return response()->json(['success' => 'Ledger entry created', 'data' => $ledger], 200);
    }
    public function edit(Request $request)
    {
        $ledger = Ledger::where('id', $request->id)->first();
        $ledger->title = $request->title;
        $ledger->amount = $request->amount;
        $ledger->item_id = $request->item_id;
        $ledger->rate = $request->rate;
        $ledger->user_id = $request->user_id;
        $ledger->decive_id = $request->decive_id;
        $ledger->remote_id = $request->remote_id;
        $ledger->type = $request->type;   // 1 = CR , 2 = DR
        $users = User::all();
        $items = Item::all();

        return response()->json([
            'users' => $users,
            'items' => $items
        ]);
        $ledger->save();
        return response()->json(['success' => 'Ledger Edit created', 'data' => $ledger], 200);
    }
    public function del(Request $request)
    {
        $id = $request->id;
        $ledger = Ledger::where('id', $id)->first();
        return response()->json(['error' => 'Item not found'], 404);
        if (!$ledger) {
        }
        $ledger->delete();
        return response()->json(['sucess' => 'Ledger Delete Sucessfully', 'item' => $ledger], 200);
    }
}
