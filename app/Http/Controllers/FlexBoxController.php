<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlexBoxController extends Controller
{
    //
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('FlexBox');
    }

}
