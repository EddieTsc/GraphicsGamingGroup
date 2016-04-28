<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;


/**
 * Class ProjectsFormController
 * \
 * dislay all info of the project that do require connection
 * @package App\Http\Controllers
 */
class ProjectsFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * require connection
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * display form to add a new project
     *
     * @return \Illuminate\Http\Response
     */

    public function form()
    {
        $user = auth::user();
        if ($user->user_type == 1 || $user->user_type == 2) return view('newProjectForm', ['user' => $user]);
        else return view('Error', ['e' => "You're not allowed to create an project"]);
    }

    /**
     * @param Request $request
     *
     * submit the add form and add into the database
     *
     * @return mixed
     */
    public function add(Request $request)
    {
        $user = auth::user();

        DB::table('projects')->insert(
            ['name' => $_POST['name'], 'description' => $_POST['description'], 'project_creator' => $user->id, 'created_at' => Carbon::now()]
        );

        $tableAdded = DB::table('projects')->orderBy('created_at','desc')->get()[0];

        DB::table('project_members')->insert(
            ['member_id' => $user->id,'project_id' => $tableAdded->id]
        );

        $project = DB::table('projects')->orderby('created_at', 'desc')->get()[0];

        if ($request->hasFile("ProjectPhoto")) {
            $image = $request->file("ProjectPhoto");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("project", $project->id . "." . $ext);
            }
        }
        return Redirect::to('/projects');
    }

    /**
     * @param $id
     *
     * display the project edit form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id)
    {
        $user = auth::user();
        $project = DB::table('projects')->where('id', '=', $id)->get();

        if (empty($project)) return view('Error', ['e' => "Unknown project"]);

        if ($user->id == $project[0]->project_creator || $user->user_type == 1) {
            return view('projectEdit', ['project' => $project]);
        } else return view('Error', ['e' => "You not allowed to edit that project"]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * submit the edit on the selected project
     *
     * @return mixed
     */
    public function edit(Request $request, $id)
    {

        DB::table('projects')
            ->where('id', '=', $id)
            ->update(['name' => $_POST['name']]);

        DB::table('projects')
            ->where('id', '=', $id)
            ->update(['description' => $_POST['description']]);

        if ($request->hasFile("ProjectPhoto")) {
            $image = $request->file("ProjectPhoto");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("project", $id . "." . $ext);
            }
        }

        return Redirect::to('/projects/' . $id);
    }

    /**
     * @param $id
     *
     * delete the selected project if the connected user is authorized to
     * put it in the "old" section
     *
     * @return mixed
     */
    public function delete($id){
        $user = auth::user();
        $project = DB::table("projects")->where('id','=',$id)->get()[0];

        $isCreator = ($user->id == $project->project_creator);
        if($isCreator){
            DB::table("projects")
                ->where('id','=',$id)
                ->update(['past' => true]);
                //->delete();
        }
        return Redirect::to('/projects/');

    }

    /**
     * @param $id
     *
     * add the connected user in the selected project
     *
     * @return mixed
     */
    public function join($id){
        $user = auth::user();

        DB::table('project_members')->insert(
            ['member_id' => $user->id, 'project_id' => $id]
        );
        return Redirect::to('/projects/'.$id);
    }

    public function quit($id){
        DB::table("project_members")
            ->where('member_id','=',auth::user()->id)
            ->where('project_id','=',$id)
            ->delete();

        return Redirect::to('/projects/'.$id);
    }
}