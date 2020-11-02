<?php

namespace App\Http\Controllers;

use App\Activity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ActivityController extends Controller
{
    
    public function __construct()
    {
        $this->activity = new Activity();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $activitys = Activity::all();

        return view("backend.activity.index",compact('activitys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getcode = $this->activity->generateCode();
        
        return view("backend.activity.create", compact('getcode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $activity = Activity::create($this->validateRequest());
        $this->storeImage($activity);
        return redirect()->back()->with(['success' => 'Activity berhasil dibuat' ]);
    }

    private function validateRequest()
    {
        return tap(request()->validate([
            'code_activity' => 'required',
            'name_activity' => 'required',
            'date'          => 'required',
            'information'   => 'required',
            'status'        => 'required',
            'price'         => 'required',
            'images'        => 'file|image|max:5000',
            'capacity'      => 'required',
        ]), function(){
            if(request()->hasFIle('images')){
                request()->validate([
                    'images'  => 'file|image|max:5000',
                ]);
            }
        }); 
    }
    private function storeImage($activity){
        if(request()->has('images')){
            $activity->update([
                'images' => request()->images->store('uploads','public'),
            ]);
            $image = Image::make(public_path('storage/'. $activity->images))->fit(300,300,null, 'top-left');
            $image->save();
        }
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view("backend.kegiatan.edit",compact('activity'));
    }
       public function update(Activity $activity)
        
    {
        $activity = Activity::create($this->validateRequest());
        $this->storeImage($activity);
        return redirect()->back()->with(['success' => 'Activity berhasil dibuat' ]);
    }
}