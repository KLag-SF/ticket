@extends('layouts.app')

@section('content')
<body>
    <form method="post" action="/group/{{$group->id}}/edit">
        @csrf
        <label for="group_name"> Group name</label>
        <input type="text" required name="group_name" value="{{$group->group_name}}">
        <button type="submit" class="btn btn-success"> Rename </button>
    </form>
</body>
@endsection