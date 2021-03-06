<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;

/**
 * Class ProjectsController
 *
 * dislay all info of the project that do not require connection
 *
 * @package App\Http\Controllers
 */
class ProjectsController extends Controller
{
    /**
     * show all actual projects
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $projects = DB::table('projects')->where('past','=',false)->orderby('id','asc')->get();
        return view('projects',['projects' => $projects]);
    }

    /**
     * @param $id
     *
     *show the info of the selected project
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($id)
    {
        $project = DB::table('projects')->where('id','=',$id)->get();

        if(!empty($project)) {
            $creator = DB::table('users')->where('id', '=', $project[0]->project_creator)->get()[0];
            $memberIDList = DB::table('project_members')->join('users', 'users.id', '=', 'project_members.member_id')->where('project_id', '=', $id)->get();
            $publications = DB::table('publications')->where('id_project','=',$project[0]->id)->get();

            $userIsCreator = false;
            $button = "none";
            if(!empty(auth::user())){
                $userIsCreator = ($creator->id == auth::user()->id) || (auth::user()->user_type == 1);

                $memberInProject = DB::table('project_members')
                    ->where('member_id','=',auth::user()->id)
                    ->where('project_id','=',$project[0]->id)
                    ->get();
                if(!empty($memberInProject) && !$userIsCreator){
                    $button = "quit";
                }
                elseif(empty($memberInProject) && !$userIsCreator && auth::user()->user_type != 3) $button = "join";
            }
            return view('projectsinfo', ['project' => $project, 'creator' => $creator, 'members' => $memberIDList, 'publications' => $publications, 'boolCreator' => $userIsCreator, 'button' =>$button]);
        }
        else return view('Error',['e' => 'Unknown Project']);
    }
}