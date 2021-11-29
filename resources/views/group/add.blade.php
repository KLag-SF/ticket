@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/group/add.css">
        <div>
            Permission Level
            <table>
                <thead>
                    <tr>
                        <td>Permission</td>
                        <td>グループ名変更・削除</td>
                        <td>メンバー追加・削除</td>
                        <td>タスク編集・削除</td>
                        <td>タスクの追加・閲覧</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Administrator</td>
                        <td>True</td>
                        <td>True</td>
                        <td>True</td>
                        <td>True</td>
                    </tr>
                    <tr>
                        <td>Manager</td>
                        <td>False</td>
                        <td>True</td>
                        <td>True</td>
                        <td>True</td>
                    </tr>
                    <tr>
                        <td>Leader</td>
                        <td>False</td>
                        <td>False</td>
                        <td>True</td>
                        <td>True</td>
                    </tr>
                    <tr>
                        <td>Member</td>
                        <td>False</td>
                        <td>False</td>
                        <td>Self only</td>
                        <td>True</td>
                    </tr>
                </tbody>
            </table>
        </div>
    <form action="/permission" method="POST">
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