@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Publication list</div>

                    <div class="panel-body">
                        <?php
                            echo "Title : ".$publication[0]->name;
                            echo "<br/> Description : ".$publication[0]->description;
                            echo '<br/> Author : <a href="../members/'.$creator->id.'">'.$creator->name.'</a>';
                            echo '<br/> Project : <a href="../projects/'.$project->id.'">'.$project->name.'</a>';
                            echo "<br/> Date : ".$publication[0]->created_at;

                            echo '<br/> <a href="http://localhost:666/GraphicsGamingGroup/public/PDF/'.$publication[0]->id.'.pdf">PDF</a>';
                            echo '<br/> <a href="http://localhost:666/GraphicsGamingGroup/public/TXT/'.$publication[0]->id.'.txt">explanation text</a>';
                            echo "<br/>";
                            echo '<button onclick="window.location.href=\'../publications/'.$publication[0]->id.'/edit \'">Edit publication</button>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
