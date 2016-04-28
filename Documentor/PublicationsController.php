<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

/**
 * Class PublicationsController
 * dislay all info of the publication that do not require connection
 * @package App\Http\Controllers
 */
class PublicationsController extends Controller
{
    /**
     * display a list of the publications in the database
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = DB::table('publications')->orderby('id','asc')->get();
        return view('publications',['publications' => $publications]);
    }

    /**
     * @param $id
     *
     * display the information of the selected publication
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id)
    {
        $publication = DB::table('publications')->where('id','=',$id)->get();
        $creator = DB::table('users')->where('id','=',$publication[0]->ID_Author)->get()[0];
        $project = DB::table('projects')->where('id','=',$publication[0]->ID_Project)->get()[0];
        return view('publicationInfo',['publication' => $publication, 'creator' => $creator,'project' => $project]);
    }
}
