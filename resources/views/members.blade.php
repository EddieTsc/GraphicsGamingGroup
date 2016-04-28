@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Member list</div>

                    <div class="panel-body">
                        <?php

                        //echo "<a href='/members'>test </a>";

                        if(isset($users)){
                            foreach ($users as $user) {
                                echo '<a href="members/'.$user->id.'">'.$user->name.'</a><br/>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
