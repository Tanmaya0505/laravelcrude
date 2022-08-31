<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Events['events'] = Event::all();
        //$Events = DB::table('events')->get();
      // print_r($Events); die();

        //$respone=['pages' => $Events->toArray()];
        return view('event.index', $Events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.addnew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            return redirect()->route('event.index')
            ->with('success','Company Has Been updated successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, $id)
    {

        $editevent['editevent']= Event::find($id);
        //print_r($editevent->name); die();
        //$event = Event::select('*')->find($id)->get();
        return view('event.edite', $editevent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //print_r($request->name); die();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }

        Event::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => $request->slug
            ]);
            return redirect()->route('event.index')
            ->with('success','Company Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event,$id)
    {
        //$event= Event::find($id);
        //$res=Event::find($id)->delete();
       // $event->delete();
     //print_r($id);die();
       $article = Event::findOrFail($id)->delete();
       return redirect()->route('event.index')
                        ->with('success','Company has been deleted successfully');
    }
}
