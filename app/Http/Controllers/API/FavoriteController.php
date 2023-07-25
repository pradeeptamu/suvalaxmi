<?php

namespace App\Http\Controllers\API;

use App\Models\Property;
use App\Models\User;
use App\Models\Userfavorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = Userfavorite::create([
            'user_id' => $request['user_id'],
            'prop_id' => $request['prop_id']]);
        return response()->json([$val]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prop = User::findOrFail($id)->favoriteProperty;
        $properties=[];
        foreach ($prop as $key=>$value){
            $ar=Property::where("id",$value->prop_id)->get();
            $ar->each(function ($value) {
                $value->time = \Carbon\Carbon::parse($value->created_at)->diffForHumans();
                unset($value->created_at);
            });
            array_push($properties,$ar[0]);
        }

        return response()->json($properties);
    }

    public function getFavorites($id,$prop_id)
    {
        $val=Userfavorite::where('user_id',$id)->where('prop_id',$prop_id)->first();
        if($val){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    public function deleteFavorites($id,$prop_id)
    {
        $val=Userfavorite::where('user_id',$id)->where('prop_id',$prop_id)->delete();
            return response()->json($val);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
