@extends('frontend.layouts.app')

@section('content')
    <div class="content">
        <div class="container" style='text-align:center'>
            <form id="contact" action="" method="get">
                @foreach($rooms as $room)
                <a href="{{ route('joinroom',$room->id) }}">{{ $room->name }}</a><br /><br />
                @endforeach
            </form>
        </div>
    </div>
@endsection