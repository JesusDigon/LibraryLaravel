<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        $services = Service::all();
        return view('payments.index', ['payments' => $payments, 'services' => $services]);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:3',
            'summary' => 'string',
            'cost' => 'required',
            'service_id' => 'required',
        ]);
    
        $payment = new payment;
        $payment->title = $request->title;
        $payment->summary = $request->summary;
        $payment->cost = $request->cost;
        $payment->Service_id = $request->Service_id;
        $payment->save();
    
        return redirect()->route('payments')->with('success', 'payment created successfully');
    }

    public function destroy($id){
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('payments')->with('success', 'payment deleted successfully');
    }

    public function show($id){
        $payment = Payment::find($id);
        $services = Service::all();
        return view('payments.show', ['payment' => $payment, 'services' => $services]);
    }

    public function update(Request $request, $id){
        $payment = Payment::find($id);
        
        $payment->title = $request->title;
        $payment->summary = $request->summary;
        $payment->cost = $request->cost;
        $payment->save();

        return redirect()->route('payments')->with('success', 'payment updated successfully');
    }
}
