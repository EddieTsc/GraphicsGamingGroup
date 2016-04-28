@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"> Project Info </div>

                    <div class="panel-body">

                        <h4> Information </h4>
                        <?php
                            $fileName= "project/".$project[0]->id.".png";
                            if(file_exists($fileName))
                                echo '<img src=../'.$fileName.' style="max-width:100px">';
                            else echo '<img src="../img/defaultP.png" style="max-width:100px">';

                            echo "  ".$project[0]->name;
                            echo "<br/> Description : ".$project[0]->description;
                            echo '<br/> Creator : <a href="../members/'.$creator->id.'">'.$creator->name.'</a>';
                            echo "<br/> Creation : ".$project[0]->created_at."<br/>";
                        ?>
                        <h4>Member List</h4>
                        <?php
                            if(isset($members)){
                                foreach($members as $member){
                                    echo '<a href="../members/'.$member->id.'">'.$member->name.'</a><br/>';
                                }
                            }
                        ?>
                        <h4>Publications List</h4>
                        <?php
                            if(isset($publications)){
                                foreach($publications as $publication){
                                    echo '<a href="../publications/'.$publication->id.'">'.$publication->name.'</a><br/>';
                                }
                            }
                        ?>
                        <br/><br/><button onclick="window.location.href='../projects'">Return to project list</button>
                        <?php
                            if($boolCreator){
                                echo "<button onclick=\"window.location.href='../projects/".$project[0]->id."/edit'\">Edit Project</button>";
                                echo "<button onclick=\"window.location.href='../projects/".$project[0]->id."/delete'\">Delete Project</button>";
                            }
                            if($button == "join") echo "<button onclick=\"window.location.href='../projects/".$project[0]->id."/join'\">Join Project</button>";
                            elseif($button == "quit") echo "<button onclick=\"window.location.href='../projects/".$project[0]->id."/quit'\">Quit Project</button>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
