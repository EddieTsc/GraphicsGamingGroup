@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Project list</div>

                    <div class="panel-body">
                        <?php

                        if(isset($projects)){
                            foreach ($projects as $project) {
                                echo '<a href="projects/'.$project->id.'">'.$project->name.'</a><br/>';
                            }
                        }
                        ?>

                        <br/><br/><button onclick="window.location.href='projects/form'">Start new project</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
