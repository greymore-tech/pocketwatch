<?php

namespace App\Http\Controllers;

use App\Tab;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TabResource;

class TabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        //  fetch all tabs based on user id
        $tabs = Tab::all()->where('user_id', $user_id);

        //  return tabs as a resource
        return TabResource::collection($tabs);
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
    public function store(Request $request, $user_id)
    {
        //  store new tab

        $tab = new Tab;
        $tab->user_id = $user_id;
        $tab->tab_name = $request->input('tab_name');

        if ($tab->save()) {
            return new TabResource($tab);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $user_id)
    {
        //  fetch tab based on tab id and user id
        $tab = Tab::where('user_id', $user_id)->FindOrFail($id);

        //  return board as a resource
        return new TabResource($tab);
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
    public function update(Request $request, $user_id)
    {
        //  fetch and update tab based on user id and tab id

        $tab = Tab::where('user_id', $user_id)->FindOrFail($request->tab_id);
        $tab->user_id = $user_id;
        $tab->tab_name = $request->input('tab_name');

        if ($tab->save()) {
            return new TabResource($tab);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $user_id)
    {
        //  fetch item based on tab id and user id
        $item = Item::where('tab_id', $id)->where('user_id', $user_id);

        //  fetch tab based on tab id and user id
        $tab = Tab::where('user_id', $user_id)->FindOrFail($id);

        if ($tab->delete()) {
            //  delete if any item(s) exist
            if ($item != null) {
                $item->delete();
            }

            //  return tab as a resource
            return new TabResource($tab);
        }
    }
}
