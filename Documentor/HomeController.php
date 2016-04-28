<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;


/**
 * Class HomeController
 *
 *  show the home page
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
