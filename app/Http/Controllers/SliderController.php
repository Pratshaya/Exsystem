<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\CreateSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Post;
use App\Slider;
use App\Status;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        $sliders = Slider::paginate(10);
        return view('slider.index')->with('sliders', $sliders)
            ->with('statuses', $statuses);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSliderRequest $request)
    {
        $image = $request->image->store('sliders');

        Slider::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'image' => $image,
            'status_id' => $request->status
        ]);
        session()->flash('success', 'Slider created successfully');
        return redirect()->route('slider.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $statuses = Status::all();
        return view('slider.edit')->with('slider',$slider)->with('statuses', $statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = $request->only(['title','detail','status']);
        if($request->hasFile('image')){
            $image = $request->image->store('sliders');
            $slider->deleteImage();
            $data['image'] = $image;
        }
        $slider->update($data);
        session()->flash('success','Slider update successfully.');
        return redirect(route('slider.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->deleteImage();
        $slider->delete();
        session()->flash('success', 'Slider deleted successfully');
        return redirect()->route('slider.index');
    }
}
