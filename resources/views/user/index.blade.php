@extends('layouts/app')

@section('content')
<header>
    <div class="user_name">
        Name: {{$user->name}}
    </div> 
    <div>
        Groups which you are belonging
</header>
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