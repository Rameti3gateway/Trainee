<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use PDF;
use Times;
use Tasks;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {   
        return view('site::Login-after.pdf');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function PDFcheckincheckout($id)
    {

        $user = Times::where('user_id','=',$id)->get();
        $pdf = PDF::loadView('site::Login-after/checkincheckoutpdf', compact('user'));
        return $pdf->download('checkincheckout.pdf');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function PDFtodolist($id)
    {
        $user = Tasks::where('user_id','=',$id)->get();
        $pdf = PDF::loadView('site::Login-after/todolistpdf', compact('user'));
        return $pdf->download('todolist.pdf');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('site::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('site::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
