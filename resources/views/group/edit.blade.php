@extends('layouts.app')

@section('content')
<body>
    <form method="post" action="/group/{{$group->id}}/edit">
        @csrf
        <label for="group_name"> Group name</label>
        <input type="text" required name="group_name" value="{{$group->group_name}}">
        <button type="submit" class="btn btn-success"> Rename </button>
    </form>
    <form method="post" action="/group/{{$group->id}}">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger"> DELETE GROUP </button>
    </form>
</body>
@endsection