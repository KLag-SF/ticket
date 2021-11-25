@extends('layouts/app')

@section('content')
<div class='user_header'>
	<div class="user_name">
 	    Name:{{$user->name}}  (ID:{{$user->id}})
	</div>
	<div class = 'group_create'>
    	<button type="button" onclick="location.href='/group/create'" class="btn btn-success">
       		NEW GROUP
	    </button>
	</div>

	    Group:
</div>
    <div class="table_main">
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
                    <span class='click_available'>
                        <td onclick="jump({{$group->id}})">
                        {{$group->group_name}} 
                         </td>
                        <td>{{$group->role_name}}
                    </span>  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
    let jump = function (iteration){
        window.location.href= "group/" + iteration;
        //alert("詳細画面へ");
    };
</script>
@endsection
