<?php
/**
 * Created by PhpStorm.
 * User: Eddie
 * Date: 20/04/2016
 * Time: 12:53
 */

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use Redirect;

/**
 * Class MembersFormController
 *
 * dislay all info of the members that do require connection
 *
 * @package App\Http\Controllers
 */
class MembersFormController extends controller
{
    /**
     * MembersFormController constructor.
     *
     * this controller require connection
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $id
     *
     * set the form to edit user profile if user have the authorization
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = auth::user();
        $editedUsers = DB::table('users')->where("id",'=',$id)->get()[0];
        $users = DB::table('users')->where("user_type",'!=','3')->where('past','=',false)->where('id','!=',$user->id)->get();


        $project = DB::table('users')->where('id', '=', $id)->get();
        if (empty($project)){
            return view('Error', ['e' => "This profile doesn't exist"]);
        }
        else if ($user->id != $id && $user->user_type != 1) {
            return view('Error', ['e' => "You not allowed to edit that profile"]);
        }
        else return view('memberEdit', ['editedUser' => $editedUsers,'users' => $users]);
    }

    /**
     * @param Request $request
     * @param $id
     *
     * get info from the members edit form and update the related user in the database with the information
     *
     * @return mixed
     */
    public function applyEdit(Request $request,$id)
    {
        if ($request->hasFile("ProfilePhoto")) {
            $image = $request->file("ProfilePhoto");
            if ($image->isValid()) {
                $ext = $image->getClientOriginalExtension();
                $image->move("user", $id . "." . $ext);
            }
        }

        $pass = $_POST['password'];
        $passConfirm = $_POST['password_confirmation'];

        if($pass == $passConfirm && strlen($pass) >= 6){
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['password' => bcrypt($pass)]);
        }

        DB::table('users')
            ->where('id', '=', $id)
            ->update(['name' => $_POST['name']]);

        DB::table('users')
            ->where('id', '=', $id)
            ->update(['email' => $_POST['email']]);

        if($_POST['Supervisor'] == 0) {
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['supervisor' => '']);
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['user_type' => 2]);
        }
        else{
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['supervisor' => $_POST['Supervisor']]);
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['user_type' => 3]);
        }
        return Redirect::to('/members');
    }

    /**
     * @param $id
     * if the user is an admin of if he is the one user selected
     * he can delete a user an put it in the past section
     *
     */
    public function DeleteMember($id){
        if(auth::user()->user_type == 1 || auth::user()->id == $id){
            DB::table('users')
                ->where('id', '=', $id)
                ->update(['past' => true]);
        }

        return Redirect::to('/members');
    }
}