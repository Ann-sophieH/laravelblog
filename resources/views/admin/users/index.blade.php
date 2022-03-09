@extends('layouts.admin')
@section('content')
    <h1 class="col-10">Users</h1>
    <div class="btn btn-info col-2 " href=""><i class="fa fa-user-plus"></i> add new user  </div>
    <table class="table  table-striped mt-5">
        <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Active</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>
                <img height="62" src="{{$user->photo ? asset($user->photo->file) : 'http://via.placeholder.com/62x62'}}" alt="{{$user->name}}">
            </td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                @foreach($user->roles as $role)
                    <span class="badge badge-pill badge-info">{{$role->name}}</span>
                @endforeach
            </td>
            <td>{{$user->is_active ==1 ? 'alive' : 'dead to me'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>

        </tr>
        @endforeach

        </tbody>
    </table>
    <div class="mx-auto mt-5">
        {{$users->render()}}
    </div>

@endsection
