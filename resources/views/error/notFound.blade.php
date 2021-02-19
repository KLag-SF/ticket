@extends('layouts.app')

@section('content')

<body>
    @component('error.error')

        @slot('code')
            404 Not found
        @endslot
    
        Your requested resource doesn't exist! <nbsp> Please check again.
    @endcomponent
</body>

@endsection