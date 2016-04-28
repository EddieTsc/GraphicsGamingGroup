@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Publication</div>

                    <div class="panel-body">
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/publications/'.$publication->id.'/submitedit') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value=<?php echo $publication->name?> >

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="description" value=<?php echo $publication->description?> >

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('project') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Project</label>

                                <div class="col-md-6">
                                    <select name="project" selected=<?php echo $publication->ID_Project?> >
                                        <?php
                                        foreach($projects as $project){
                                            if($project->id == $publication->ID_Project) echo '<option value="'.$project->id.'" selected>'.$project->name.'</option>';
                                            else echo '<option value="'.$project->id.'">'.$project->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                    @if ($errors->has('project'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('project') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('PDF') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">PDF</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="PDF">

                                    @if ($errors->has('PDF'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('PDF') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('TXT') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">TXT</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="TXT">

                                    @if ($errors->has('TXT'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('TXT') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Edit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
