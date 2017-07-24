<div style="margin:30px" >
    <form id="contact" action="" method="get">
        @foreach($rooms as $room)
            <a style="text-decoration:none" href="{{ route('joinroom',$room->id) }}">{{ $room->name }}</a><br /><br />
        @endforeach
    </form>
</div>
