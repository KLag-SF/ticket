@extends('layouts.app')

@section('content')
    <div class="group-name">
        GROUP:{{$group->group_name}}
    </div>

    <div class="add-user">
        <button class="btn btn-primary" onclick="location.href='member/add'">
            Add user
        </button>
    </div>

    <div class="member-list">
        <table class="table">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>UserName</th>
                    <th>Permission</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->role_name}}</td>
                    <td>
                        @if($lv > 0 && $lv <= 2)
                        <form action="member/remove" method="post">
                            @csrf
                            <input type="hidden" name="group_id" value="{{$group->id}}">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <button type="submit" class="btn btn-danger">
                                @if($user->id == $currentId)
                                    Leave
                                @else
                                    Remove
                                @endif
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function remove(user_id){
            let group_id = {{$group -> id}};
            const form = document.createElement('form');
            form.method = "POST";
            form.action = "member/remove";

            const uidField = document.createElement('input');
            uidField.type = 'hidden';
            uidField.name = "user_id";
            uidField.value = user_id;
            form.appendChild(uidField);

            const gidField = document.createElement('input');
            gidField.type = 'hidden';
            gidField.name = 'group_id';
            gidField.value = group_id;
            form.appendChild(gidField);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endsection