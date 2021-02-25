@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            New ticket
        </div>
        <div class="card-body">
            <form action="/group/{{$id}}/ticket" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">
                        Task Title
                    </label>
                    <input name="title" class="form-control" type="text"/>
                </div>
                <div>
                    <label for="detail">
                        Detail
                    </label>
                    <textarea name="detail"></textarea>
                </div>
                <div>
                    <label for="limit">
                        Limit
                    </label>
                    <input type="date" name="limit"/>
                </div>
                <div>
                    <label for="progress">
                        Progress
                    </label>
                    <input type="number" name="progress"/>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection