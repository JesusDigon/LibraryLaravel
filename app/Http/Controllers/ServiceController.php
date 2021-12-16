<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('services.index', ['services' => $services]);
    }

    public function store(Request $request)
    {

        
        $this->validate($request, [
            'name' => 'required|unique:services|max:255',
            'color' => 'required|max:7',
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->color = $request->color;
        $service->save();

        return redirect()->route('services.index')->with('success', 'service has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        return view('services.show', ['service' => $service]);       
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
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        
        $service->name = $request->name;
        $service->color = $request->color;
        $service->save();

        return redirect()->route('services.index')->with('success', 'service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        // $service->todos()->each(function($todo) {
        //     $service->delete(); // <-- direct deletion
        //  });
        $service->delete();
        return redirect()->route('services.index')->with('success', 'service deleted successfully');
    }

}
