@extends('layouts/app')

@section('content')
<div class="user_name">
    Name:{{$user->name}}
</div>
<div>
    <button type="button" onclick="location.href='/group/create'" class="btn btn-success">
        NEW GROUP
    </button>
</div>
<div>
    Groups which you are belonging
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Permission</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
            <tr>
                <td>{{$group->group_name}}</td>
                <td>{{$group->role_name}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection