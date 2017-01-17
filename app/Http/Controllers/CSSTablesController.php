<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSSTablesController extends Controller
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
        return view('CSSTables');
    }


}
