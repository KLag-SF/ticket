@extends('layouts.app')

@section('content')
    <div class="form-group">
        <label for="name">Group name</label>
        <form method="post" action="/group">
            @csrf
            <input name="name" class="form-control"/>
            <button class="btn btn-success" type="submit">作成</button>
        </form>
    </div>
@endsection