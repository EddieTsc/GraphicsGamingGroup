@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Old</div>

                    <div class="panel-body">
                        <h4>List of old Users</h4>
                        <?php
                        if(isset($users)){
                            foreach ($users as $user) {
                                echo '<a href="members/'.$user->id.'">'.$user->name.'</a><br/>';
                            }
                        }
                        ?>
                        <h4>List of old projects</h4>
                        <?php
                        if(isset($projects)){
                            foreach ($projects as $project) {
                                echo '<a href="project/'.$project->id.'">'.$project->name.'</a><br/>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
