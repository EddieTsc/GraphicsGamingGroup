<?php
/**
 * 
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;
use Carbon\Carbon;

/**
 * Class PublicationsFormController
 *
 * dislay all info of the publication that do require connection
 *
 * @package App\Http\Controllers
 */
class PublicationsFormController extends Controller
{
    /**
     *Create a new controller instance.
     *
     * require connection
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * display the form to add a publication
     *
     * @return \Illuminate\Http\Response
     */
    public function form(){
        $user = auth::user();
        $projects = DB::table('projects')->where('past','=',false)->get();
        if ($user->user_type == 1 || $user->user_type == 2) return view('newPublicationForm', ['user' => $user, 'projects' => $projects]);
        else return view('Error', ['e' => "You're not allowed to add a publication"]);
    }

    /**
     * @param Request $request
     *
     * add the publication in the database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $user = auth::user();

        if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['project']) || empty($_POST['PDF']) || empty($_POST['TXT'])) return view('Error',['e' => "Missing Information"]);

        DB::table('publications')->insert(
            ['name' => $_POST['name'], 'description' => $_POST['description'], 'ID_Author' => $user->id,'ID_Project' => $_POST['project'], 'created_at' => Carbon::now()]
        );

        $publi = DB::table('publications')->orderby('created_at', 'desc')->get()[0];


        if ($request->hasFile("PDF")) {
            $image = $request->file("PDF");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("PDF", $publi->id . "." . $ext);
            }
        }

        if ($request->hasFile("TXT")) {
            $image = $request->file("TXT");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("TXT", $publi->id . "." . $ext);
            }
        }
        return Redirect::to('/publications');
    }

    /**
     * @param $id
     *
     *  set the form to edit the selected publication
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $user = auth::user();
        $publi = DB::table('publications')->where('id', '=', $id)->get()[0];
        $projects = DB::table('projects')->where('past', '=', false)->get();

        if (empty($publi)) return view('Error', ['e' => "Unknown publication"]);

        if ($user->user_type == 2 || $user->user_type == 1) {
            return view('publicationEdit', ['publication' => $publi,'projects' => $projects]);
        } else return view('Error', ['e' => "You not allowed to edit that publication"]);
    }


    /**
     * @param Request $request
     * @param $id
     *
     * submit the modifications of the selected publication into the database
     *
     * @return mixed
     */
    public function submit(Request $request, $id){
        DB::table('publications')
            ->where('id', '=', $id)
            ->update(['name' => $_POST['name']]);

        DB::table('publications')
            ->where('id', '=', $id)
            ->update(['description' => $_POST['description']]);

        DB::table('publications')
            ->where('id', '=', $id)
            ->update(['ID_Project' => $_POST['project']]);

        if ($request->hasFile("PDF")) {
            $image = $request->file("PDF");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("PDF", $id . "." . $ext);
            }
        }

        if ($request->hasFile("TXT")) {
            $image = $request->file("TXT");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("TXT", $id . "." . $ext);
            }
        }
        return Redirect::to('/publications');
    }
}
