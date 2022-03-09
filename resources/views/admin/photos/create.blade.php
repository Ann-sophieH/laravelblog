@extends('layouts.admin')
@section('content')

    <div class="col-12">
        @include('includes.form_error')
        <h1>Create new photo</h1>
    </div>


    <div class="col-10 mx-auto mt-5 card p-2 pb-3 mb-5">
        {!! Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\AdminUsersController@store', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class'=>'form-control shadow']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class'=>'form-control shadow']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Select roles: (CTRL + click multiple)') !!}
            {!! Form::select('roles[]', $roles, null, ['class'=>'form-control shadow ', 'multiple'=>'multiple'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('is_active', 'Status:') !!}
            {!! Form::select('is_active', array(1=>'active', 0=>'not active'), 1, ['class'=>'form-control shadow'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password:') !!}
            {!! Form::password('password',['class' =>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id',null, ['class'=>'form-control shadow'] ) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create user', ['class'=>'btn btn-info '] ) !!}
        </div>
        {!! Form::close() !!}

    </div>


@endsection
