<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Eventapi extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Events = Event::all();
        //$Events = DB::table('events')->get();
      // print_r($Events); die();

        //$respone=['pages' => $Events->toArray()];
        return response()->json($Events->toArray(),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // print_r($request->slug); die();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }

        $event = new Event;

        $event->name = $request->name;
        $event->slug = $request->slug;

        $success=$event->save();
        if($success){
            $respone = ['message' => 'insert data succufully'];
            return response()->json($respone,200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Event::find($id);

        return response()->json($student,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // print_r($id); die();
        $event= Event::find($id);
        //$event = Event::select('*')->find($id)->get();
        return response()->json($event,200);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }

        Event::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $request->slug
            ]);
            $respone= ['message' => 'Event Updated Successfully'];
        return response()->json($respone,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //$event= Event::find($id);
        //$res=Event::find($id)->delete();
       // $event->delete();
       $article = Event::findOrFail($id)->delete();
        return respones()->json('Event Deleted Successfully',200);
    }
}
