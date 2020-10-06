<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ItemResource;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //  fetch all items based on user id
        $items = Item::all()->where('user_id', $user_id);

        //  return items as a resource
        return ItemResource::collection($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tab_id, $user_id)
    {
        //  store new item

        $item = new Item;
        $item->user_id = $user_id;
        $item->tab_id = $tab_id;
        $item->item_name = $request->input('item_name');
        $item->item_amount = $request->input('item_amount');
        $item->item_is_income = $request->input('item_is_income');

        if ($item->save()) {
            return new ItemResource($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $tab_id, $user_id)
    {
        //  fetch item based on item id, tab id and user id
        $item = Item::where('tab_id', $tab_id)->where('user_id', $user_id)->FindOrFail($id);

        //  return item as resource
        return new ItemResource($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tab_id, $user_id)
    {
        //  fetch and update item based on item id, tab id and user id

        $item = Item::where('tab_id', $tab_id)->where('user_id', $user_id)->FindOrFail($request->item_id);
        // $item->user_id = $user_id;
        // $item->tab_id = $tab_id;
        $item->item_name = $request->input('item_name');
        $item->item_amount = $request->input('item_amount');
        // $item->item_is_income = $request->input('item_is_income');

        if ($item->save()) {
            return new ItemResource($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $tab_id, $user_id)
    {
        //  fetch item based on item id, tab id and user id
        $item = Item::where('tab_id', $tab_id)->where('user_id', $user_id)->FindOrFail($id);

        if ($item->delete()) {
            //  return task as resource
            return new ItemResource($item);
        }
    }
}
