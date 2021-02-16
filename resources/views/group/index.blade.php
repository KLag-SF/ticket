@extends('layouts.app')

@section('content')
<body>
    <div class="group-header">
        <a href="/group/{{$group->id}}/member">{{$group->group_name}}</a>
        <button class="btn btn-primary"> New Ticket</button>
    </div>
</body>
@endsection