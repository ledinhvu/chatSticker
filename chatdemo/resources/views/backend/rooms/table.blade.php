<?php use App\Components\Util; ?>
<table class="table table-responsive" id="rooms-table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th>Role</th>
        <th>Action</th>
    </thead>
    <tbody>
    @foreach($rooms as $rooms)
        <tr>
            <td>{{ $rooms->name }}</td>
            <td>{{ Util::theExcerpt($rooms->description) }}</td>
            @if($rooms->role == 1)
            <td>Public</td>
            @else
            <td>Protected</td>
            @endif
            <td>
                {!! Form::open(['route' => ['rooms.destroy', $rooms->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('rooms.show', [$rooms->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('rooms.edit', [$rooms->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
