<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Payment;
use DateTime;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        $services = Service::all();
        return view('payments.index', ['payments' => $payments, 'services' => $services]);
    }

    public function store(Request $request){
        //dd($request);die;
        $request->validate([
            'title' => 'required|min:3',
            'date' => 'required|date_format:Y-m-d',
            'cost' => 'required',
            'status' => 'sometimes|boolean',
            'service_id' => 'required',
        ]);
    
        $payment = new Payment;
        $payment->title = $request->title;
        $payment->date = $request->date;
        $payment->cost = $request->cost;
        $payment->payed = $request->status ?? 0;
        $payment->service_id = $request->service_id;
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
        $date = new DateTime($payment->date);
        $payment->date = $date->format('Y-m-d');
        $services = Service::all();
        return view('payments.show', ['payment' => $payment, 'services' => $services]);
    }

    public function update(Request $request, $id){
        $payment = Payment::find($id);
        $payment->title = $request->title;
        $payment->date = $request->date;
        $payment->cost = $request->cost;
        $payment->payed = $request->status ?? 0;
        $payment->service_id = $request->service_id;
        $payment->save();

        return redirect()->route('payments')->with('success', 'payment updated successfully');
    }
}
