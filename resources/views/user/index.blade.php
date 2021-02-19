@extends('layouts/app')

@section('content')
<div class='user_header'>
	<div class="user_name">
 	   Name:{{$user->name}}
	</div>
	<div class = 'group_create'>
    	<button type="button" onclick="location.href='/group/create'" class="btn btn-success">
       		NEW GROUP
	    </button>
	</div>

	    Group:
</div>
    <div>
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
