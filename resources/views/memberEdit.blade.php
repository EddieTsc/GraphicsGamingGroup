@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit member</div>
                    <div class="panel-body">
                        <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/members/'.$editedUser->id.'/submitedit') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" value={{$editedUser->name}}>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value={{$editedUser->email}}>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('Supervisor') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Supervisor</label>

                                <div class="col-md-6">
                                    <select name="Supervisor">
                                        <option value="0">Only for student</option>
                                        <?php
                                        foreach($users as $user){
                                            if($user->id == $editedUser->supervisor) echo '<option value="'.$user->id.'" selected>'.$user->name.'</option>';
                                            else echo '<option value="'.$user->id.'">'.$user->name.'</option>';
                                        }
                                        ?>
                                    </select>
                                    @if ($errors->has('Supervisor'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Supervisor') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('Profile photo') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Profile photo</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="ProfilePhoto">

                                    @if ($errors->has('Profile photo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('Profile photo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Register
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
