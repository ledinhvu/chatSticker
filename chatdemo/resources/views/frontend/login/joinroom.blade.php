        @if(Auth::user()->id == '1')
            <div>
                <button type="submit" class=""><a href="{{ route('choosemem', $id) }}">Add Member</a></button>
            </div>
        @endif
        <div>
            <h3>Messages</h3>
        </div>
        <div id="all_messages" style="width:300px;height:300px;overflow:scroll;word-wrap:break-word;overflow-x:hidden">
           @if(!$messages->isEmpty())
                @foreach($messages as $messages)
                    @if($messages->user->role == "1")
                        <div><strong>{!! $messages->user->name !!}</strong>
                        <span style="color:purple">(Admin)</span>: {!! $messages->content !!}</div>
                    @else
                        <div><strong>{!! $messages->user->name !!}</strong>: {!! $messages->content !!}</div>
                    @endif
                @endforeach
           @endif
            <div id="messages">

            </div>
        </div>
        <div id="result"></div> 
        <form id="form-sub">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- <input type="text" name="message" id = "message-content"> -->
            <input type="hidden" name="id_room" id = "id_room" value="{{ $id }}">
            <textarea name="message" id="message-content" style="margin-bottom:-5px;width:250px"></textarea>
            <input type="submit" value="send">
        </form>
  

    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <script type = "text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });

            $('#form-sub').submit(function (e) {
                e.preventDefault();
                
                // var message = $('#message-content').val();
                var request = $.ajax({
                    type: "get",
                    url: '/sendmessage',
                    data: {
                        'message' : $('#message-content').val(),
                        'id_room' : $('#id_room').val(),
                    }
                });
                //reset input & focus
                document.getElementById("message-content").value = "";
                $("#message-content").focus();

                request.done(function (response, textStatus, jqXHR){
                    //console.log("Response: " + response);
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    //console.error("error");
                });

            });
        });

        var socket = io.connect('http://localhost:8890');
        socket.on('message', function (data) {
            var message = JSON.parse(data);
            if(message.user.role==1) {
                $( "#messages" ).append( "<p><strong>"+message.user.name+
                " </strong><span style='color:purple'>(Admin)</span>: "+message.content +"</p>" );
            } else {
                $( "#messages" ).append( "<p><strong>"+message.user.name+"</strong>: "+message.content +"</p>" );
            }
            
            //auto bottom scroll
            var container = $('#all_messages');
            container.scrollTop(container.get(0).scrollHeight);
            document.body.scrollTop = document.body.scrollHeight;
        });
    </script>
