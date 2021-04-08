@extends('layouts.users.colors')

@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

@section('style')
    <style>
        .image_container {
            position:absolute;
            max-width:45%;
            max-height:45%;
            top:50%;
            left:50%;
            overflow:visible;
        }

        .icon {
            position:relative;
            max-width:100%;
            max-height:100%;
            margin-top:-50%;
            margin-left:-50%;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    @php
        $counter = 1;
        $selected_color = 0;
    @endphp

    @foreach ($colors as $color)
        <button value="{{ $color->hex_value }}" class="btn @if($counter % 2 == 0) button-next-to-another @endif" style="background-color: #{{ $color->hex_value }};"></button>

        @php
            $counter++;
        @endphp
    @endforeach

    <div class="image_container">
        <img class="icon" src="{{URL::asset('/images/trash-icon.png')}}">
    </div>

    <script>
        $(document).ready(function() {
            $('.btn').click(function () {
                $hex_value = $(this).val();
            });

            $('.icon').click(function () {
                window.location = 'delete-color/' + $hex_value;
            });
        });
    </script>
@endsection