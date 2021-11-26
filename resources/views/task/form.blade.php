@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            New ticket
        </div>
        <div class="card-body">
            @if($target == 'update')
                <form action="/task/{{$task->id}}" method="POST">
                    <input name="_method" value="PUT" type="hidden">
            @elseif($target == 'create')
                <form action="/group/{{$id}}/ticket" method="POST">
            @endif
                @csrf
                <div class="form-group">
                    <label for="title">
                        Task Title
                    </label>
                    <input name="title" class="form-control" type="text" value="{{$task->id}}"/>
                </div>
                <div>
                    <label for="detail">
                        Detail
                    </label>
                    <textarea name="detail">{{$task->detail}}</textarea>
                </div>
                <div>
                    <label for="limit">
                        Limit
                    </label>
                    <input type="date" name="limit" value="{{$task->limit}}"/>
                </div>
                <div>
                    <label for="progress">
                        Progress
                    </label>
                    <input type="number" name="progress" value="{{$task->progress}}"/>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            @if($target == "update")
                <form action="/task/{{$task->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger" type="submit">Delete this task</button>
                </form>
            @endif
        </div>
    </div>
@endsection