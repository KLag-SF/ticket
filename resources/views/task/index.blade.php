@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/ticket/index.css">
    <div class="title text-center my-3">
        <h3> {{ $task -> title}} </h3>
    </div>
    <div class="detail">
        <table class="mx-auto">
            <tbody>
                <tr>
                    <td> Detail: </td>
                    <td> {{$task->detail}} </td>
                </tr>
                <tr>
                    <td> Limit: </td>
                    <td> {{$task -> limit}} </td>
                </tr>
                <tr>
                    <td> progress: </td>
                    <td> {{$task-> progress}} </td>
                </tr
            </tbody>
        </table>
    </div>
@endsection