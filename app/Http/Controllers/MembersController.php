<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Mockery\CountValidator\Exception;
use Auth;

/**
 * Class MembersController
 *
 * dislay all info from the members that do not require connection
 *
 * @package App\Http\Controllers
 */

class MembersController extends Controller
{
    /**
     * Display the list of all members and link to page info
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = DB::table('users')->where('past','=',false)->orderby('id','asc')->get();
        return view('members',['users' => $users]);
    }

    /**
     * @param $id
     *
     * Display the information of the user with the id equals to $id
     * gets the projects involved in and the publications
     *
     * give the possibility to edit members information if you have the authorization
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id)
    {
        $user = DB::table('users')->where('id','=',$id)->get();
        $projects = [];
        $supervisor = '';

        if(!empty($user)){
            $projects_id = DB::table('project_members')->where('member_id', '=', $user[0]->id)->get();
            if(isset($projects_id[0])) $projects = DB::table('projects')->where('id', '=', $projects_id[0]->project_id)->get();

            $publications = DB::table('publications')->where('ID_Author', '=', $user[0]->id)->get();

            $supervisor = DB::table('users')->where('id','=',$user[0]->supervisor)->get();

            $connected = Auth::user();

            $canEdit = false;
            if(isset(Auth::user()->id)) $canEdit = (Auth::user()->user_type == 1 || Auth::user()->id == $id);
            return view('membersInfo',['user' => $user,'supervisor' => $supervisor,'projects' => $projects, 'publications' => $publications, 'canEdit' => $canEdit, 'connected' => $connected]);

        }
        else return view('Error',['e' => 'Unknown User']);
    }
}
