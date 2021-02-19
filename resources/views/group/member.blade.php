@extends('layouts.app')

@section('content')
    <div class="group-name">
        {{$group->group_name}}
    </div>

    <div class="add-user">
        <button class="btn btn-primary" onclick="location.href='member/add'">
            Add user
        </button>
    </div>

    <div class="member-list">
        <table class="table">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>UserName</th>
                    <th>Permission</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role_name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection