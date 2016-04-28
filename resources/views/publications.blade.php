@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Publication list</div>

                    <div class="panel-body">
                        <?php

                        if(isset($publications)){
                            foreach ($publications as $publication) {
                                echo '<a href="publications/'.$publication->id.'">'.$publication->name.'</a><br/>';
                            }
                        }
                        ?>

                        <br/><br/><button onclick="window.location.href='publications/form'">New publication</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
