<table class="table table-responsive" id="messages-table">
    <thead>
        <th>Content</th>
        <th>UserName</th>
        <th>Room</th>
        <th>Role</th>
        <th>Action</th>
    </thead>
    <tbody>
    @foreach($messages as $messages)
        <tr>
            <td>{!! $messages->content !!}</td>
            <td>{!! $messages->user->name !!}</td>
            <td>{!! $messages->rooms->name !!}</td>
            @if($messages->user->role == 1)
                <td>Admin</td>
            @else
                <td>User</td>
            @endif
            <td>
                {!! Form::open(['route' => ['messages.destroy', $messages->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('messages.show', [$messages->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('messages.edit', [$messages->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>