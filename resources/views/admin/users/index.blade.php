@extends('layouts.admin')
@section('content')
    <h1>Users</h1>
    <table class="table  table-striped">
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
            <td>{{$user->photo_id}}</td>
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
