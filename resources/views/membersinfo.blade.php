@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> User Info </div>

                    <div class="panel-body">

                        <h4> Information </h4>
                        <?php
                            $fileName= "user/".$user[0]->id.".png";
                            if(file_exists($fileName))
                                echo '<img src=../'.$fileName.' style="max-width:100px">';
                            else echo '<img src="../img/default.png" style="max-width:100px">';

                            echo "Name : ".$user[0]->name."<br/>";
                            echo "E-mail : ".$user[0]->email."<br/>";
                            echo "Sign in : ".$user[0]->created_at."<br/>";
                            echo "<br/> User Type : ";
                            switch($user[0]->user_type){
                                case 1: echo "Administrator <br/>";break;
                                case 2: echo "Member <br/>";break;
                                case 3: echo "Student <br/>";
                                        echo 'Supervisor : <a href="../members/'.$supervisor[0]->id.'"">'.$supervisor[0]->name.'</a><br/>';
                                        break;
                            }
                        ?>
                        <h4>List of projects</h4>
                        <?php
                            if(isset($projects)){
                                foreach($projects as $project){
                                    echo '<a href="../projects/'.$project->id.'">'.$project->name.'</a><br/>';
                                }
                            }
                        ?>
                        <h4>List of publications</h4>
                        <?php
                            if(isset($publications)){
                                foreach($publications as $publication){
                                    echo '<a href="../publications/'.$publication->id.'">'.$publication->name.'</a><br/>';
                                }
                            }
                        ?>

                        <br/><br/><button onclick="window.location.href='../members'">Return to member list</button>

                        <?php
                            if($canEdit) echo '<button onclick="window.location.href=\'../members/'.$user[0]->id.'/edit \'">Edit Profile</button>';
                            if(!empty($connected) && ($connected->user_type == 1 || $connected->id == $user[0]->id)) echo '<button onclick="window.location.href=\'../membersDel/'.$user[0]->id.' \'">Delete Profile</button>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
