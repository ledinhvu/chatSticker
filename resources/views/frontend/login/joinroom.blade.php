@extends('frontend.layouts.app')

@section('content')
    <section class="content-header">
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    </section>
    <div class="content">
        <div class="container">
            <form id="contact" action="" method="get">
            @if($role == '1')
                <div>
                    <button type="submit" class=""><a href="{{ route('choosemem', $id) }}">Add Member</a></button>
                </div>
            @endif
                <div class="table table-responsive" id="messages-table">
                    <div>
                        <h3>Messages</h3>
                    </div>
                    <div id="messages" style="width:300px;height:300px;overflow:scroll;
                        word-wrap:break-word;overflow-x:hidden">
                    @foreach($messages as $messages)
                        <div>
                        @if($messages->user->role == "1")
                            <div><strong>{!! $messages->user->name !!}</strong> <span style="color:purple">(Admin)</span>: {!! $messages->content !!}</div>
                        @else
                            <div><strong>{!! $messages->user->name !!}</strong> (Member): {!! $messages->content !!}</div>
                        @endif
                        </div>
                    @endforeach
                    </div>
                </div>
                <form id="form-sub">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" name="message" id = "message-content">
                <input type="submit" value="send">
            </form>
            <div id="result"></div>          
            </form>
               
        </div>
    </div>

    <script type = "text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $('#form-sub').submit(function (e) {
                e.preventDefault();
                
                // var message = $('#message-content').val();
                var request = $.ajax({
                    type: "post",
                    url: '/sendmessage',
                    data: {
                        'message' : $('#message-content').val(),
                    }
                });
                //reset input & focus
                document.getElementById("message-content").value = "";
                $("#message-content").focus();

                request.done(function (response, textStatus, jqXHR){
                    // console.log("Response: " + response.user.id);
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    console.error("error");
                });

            });
        });

        var socket = io.connect('http://localhost:8890');
        socket.on('message', function (data) {
            $( "#messages" ).append( "<p>"+data+"</p>" );
            //auto bottom scroll
            var container = $('#messages');
            container.scrollTop(container.get(0).scrollHeight);
        });
    </script>

@endsection