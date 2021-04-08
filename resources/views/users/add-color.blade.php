@extends('layouts.users.colors')

@section('content')

    @php
        $counter = 1;
    @endphp

    @foreach ($colors as $color)
        <script>
            console.log({{ $color->id }});
        </script>

        <button class="btn @if($counter % 2 == 0) button-next-to-another @endif" style="background-color: #{{ $color->hex_value }};" onclick="window.location = '{{ route('colors.add-new-user-color', ['user' => $user, 'color' => $color->hex_value]) }}'"></button>

        @php
            $counter++;
        @endphp
    @endforeach

@endsection