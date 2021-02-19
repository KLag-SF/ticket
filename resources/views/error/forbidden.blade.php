@extends('layouts.app')

@section('content')

<body>
    @component('error.error')

        @slot('code')
            403 Forbidden
        @endslot
    
        You don't have permission to access this page!
    @endcomponent
</body>

@endsection