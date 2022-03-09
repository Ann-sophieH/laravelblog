@extends('layouts.admin')
@section('content')

    <div class="col-12">
        @include('includes.form_error')
        <h1>Update user</h1>

    <div class="row">
        <div class="col-8">
            <div class=" mx-auto mt-5 card p-2 pb-3 mb-5">
                {!! Form::open(['method'=>'patch', 'action'=>['App\Http\Controllers\AdminUsersController@update', $user->id], 'files'=>true]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', $user->name , ['class'=>'form-control shadow']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', $user->email, ['class'=>'form-control shadow']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Select roles: (CTRL + click multiple)') !!}
                    {!! Form::select('roles[]', $roles , $user->roles->pluck('id')->toArray() , ['class'=>'form-control shadow ', 'multiple'=>'multiple'] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('is_active', 'Status:') !!}
                    {!! Form::select('is_active', array(1=>'active', 0=>'not active'), $user->is_active, ['class'=>'form-control shadow'] ) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password',['class' =>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id', 'Photo:') !!}
                    {!! Form::file('photo_id',null, ['class'=>'form-control shadow'] ) !!}
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        {!! Form::submit('Update user', ['class'=>'btn btn-info '] ) !!}

                    </div>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['App\Http\Controllers\AdminUsersController@destroy', $user->id]] ) !!}
                    {!! Form::submit('Delete user', ['class'=>'btn btn-danger '] ) !!}
                    {!! Form::close() !!}
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
        <div class="col-4">
            <img class="img-fluid img-thumbnail mt-5" src="{{$user->photo ? asset($user->photo->file) :  'http://via.placeholder.com/400'}}"></img>
        </div>
    </div>

    </div>


@endsection
