<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Log;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id', 'asc')->get();
        return response()->json($items);
    }

    public function update(Request $request, Item $item)
    {
        $data = Item::where('id',$item->id)->first();
        
        $data->packedQuantity = $request->packed != null ? $request->packed : $item->packedQuantity;
        $data->bulkQuantity = $request->bulk != null ? $request->bulk : $item->bulkQuantity;
        $data->material1Quantity = $request->m1 != null ? $request->m1 : $item->material1Quantity;
        $data->material2Quantity = $request->m2 != null ? $request->m2 : $item->material2Quantity;
        $data->material3Quantity = $request->m3  != null ? $request->m3 : $item->material3Quantity;
        
        $data->save();

        $increased_packedQuantity = ($request->packed != null && $item->packedQuantity <= $request->packed) ? abs($request->packed - $item->packedQuantity) : 0;
        $increased_bulkQuantity = ($request->bulk != null && $item->bulkQuantity <= $request->bulk) ? abs($request->bulk -  $item->bulkQuantity) : 0;
        $increased_material1Quantity = ($request->m1 != null && $item->material1Quantity <= $request->m1) ? abs($request->m1 - $item->material1Quantity) : 0;
        $increased_material2Quantity = ($request->m2 != null && $item->material2Quantity <= $request->m2) ? abs($request->m2 - $item->material2Quantity) : 0;
        $increased_material3Quantity = ($request->m3  != null && $item->material3Quantity <= $request->m3) ? abs($request->m3 - $item->material3Quantity) : 0;

        $decreased_packedQuantity = ($request->packed != null && $item->packedQuantity >= $request->packed) ? abs($item->packedQuantity-$request->packed) : 0;
        $decreased_bulkQuantity = ($request->bulk != null && $item->bulkQuantity >= $request->bulk) ? abs($item->bulkQuantity-$request->bulk) : 0;
        $decreased_material1Quantity = ($request->m1 != null && $item->material1Quantity >= $request->m1) ? abs($item->material1Quantity-$request->m1) : 0;
        $decreased_material2Quantity = ($request->m2 != null && $item->material2Quantity >= $request->m2) ? abs($item->material2Quantity-$request->m2) : 0;
        $decreased_material3Quantity = ($request->m3  != null && $item->material3Quantity >= $request->m3) ? abs($item->material3Quantity-$request->m3) : 0;

        $itemLogforpacked = Log::Create([
            'itemCode'     => $item->itemCode,
            'type' => 'packed',
            'increase'     => $increased_packedQuantity,
            'decrease'   => $decreased_packedQuantity,
            'itemId'   => $item->id
        ]);

        $itemLogforbulk = Log::Create([
            'itemCode'     => $item->itemCode,
            'type' => 'bulk',
            'increase'     => $increased_bulkQuantity,
            'decrease'   => $decreased_bulkQuantity,
            'itemId'   => $item->id
        ]);

        $itemLogform1 = Log::Create([
            'itemCode'     => $item->itemCode,
            'type' => 'material1',
            'increase'     => $increased_material1Quantity,
            'decrease'   => $decreased_material1Quantity,
            'itemId'   => $item->id
        ]);

        $itemLogform2 = Log::Create([
            'itemCode'     => $item->itemCode,
            'type' => 'material2',
            'increase'     => $increased_material2Quantity,
            'decrease'   => $decreased_material2Quantity,
            'itemId'   => $item->id
        ]);

        $itemLogform3 = Log::create([
            'itemCode'     => $item->itemCode,
            'type' => 'material3',
            'increase'     => $increased_material3Quantity,
            'decrease'   => $decreased_material3Quantity,
            'itemId'   => $item->id
        ]);

        return response()->json([
            'message'=>'Item Updated Successfully!!',
            'item'=>$data
        ]);
    }
}
