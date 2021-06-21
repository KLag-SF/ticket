@extends('layouts.app')

@section('content')
    <form method="POST" action="/permission">
        @csrf
        <input type="hidden" name="group_id" value="{{$group->id}}"/>
        
        <label for="user_id">User ID</label>
        <input type="number" name="user_id" id="user_id"/>

        <label for="level">Permission Level</label>
        <select name="level" >
            <option value="1">Administrator</option>
            <option value="2">Manager</option>
            <option value="3">Leader</option>
            <option value="4">Member</option>
        </select>

        <button type="submit" class="btn btn-success">Add user</button>
    </form>
@endsection