@extends('layouts.app')

@section('content')
    <div class="group-name">
        GROUP:{{$group->group_name}}
    </div>
    @if($lv > 0 && $lv <= 2)
    <div class="add-user">
        <button class="btn btn-primary" onclick="location.href='member/add'">
            Add user
        </button>
    </div>
    @endif

    <div class="member-list">
        <table class="table">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>UserName</th>
                    <th>Permission</th>
                    <th>Remove&#047;Leave</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role_name}}</td>
                    <td>
                        @if($lv > 0 && $lv <= 2 || $user->id == $currentId)
                        <form action="member/remove" method="post">
                            @csrf
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-danger">
                                @if($user->id == $currentId)
                                    Leave
                                @else
                                    Remove
                                @endif
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
