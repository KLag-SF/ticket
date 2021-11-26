@extends('layouts.app')

@section('content')
<body>
    <div class="group-header">
        {{$group->group_name}}
        <button class="btn btn-primary" onclick="location.href='{{$group->id}}/ticket'"> New Ticket</button>
        <button class="btn btn-secondary" onclick="location.href='{{$group->id}}/member'">Member List</button>
        @if($lv > 0 && $lv <= 2)
        <button class="btn btn-secondary" onclick="location.href='{{$group->id}}/edit'">Group Configs</button>
        @endif
	<div class="table-main">
		<table class="table">
            <thead>
                <tr>
                    <th>Title</th>
		            <th>Limit</th>
		            <th>Progress</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <span>
                            <td onclick="location.href='/task/{{$task->id}}'"> {{$task->title}} </td>
			                <td> {{$task->limit}} </td>
		    	            <td> {{$task->progress}} &#37; </td>
                            <td>
                                <button class="btn btn-success" onclick="location.href='/task/{{$task->id}}/update'">
                                    Edit
                                </button>
                            </td>
                        </span>  
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
    </div>
</body>
@endsection
