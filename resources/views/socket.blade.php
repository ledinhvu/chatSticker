@extends('app')

@section('content')
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" >
                <div id="messages" ></div>
            </div>
        </div>
    </div>
    <script>
        var socket = io.connect('http://localhost:8890');

        socket.on('message', function (data) {
            console.log(data);
            $( "#messages" ).append( "<p>"+data+"</p>" );
        });

    </script>


@endsection