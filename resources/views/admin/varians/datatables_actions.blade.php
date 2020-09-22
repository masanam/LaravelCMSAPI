{!! Form::open(['route' => ['admin.varians.destroy', $id], 'method' => 'delete']) !!}
{{-- <div class='btn-group'> --}}
    <a href="{{ route('admin.varians.show', $id) }}" class='btn btn-outline-secondary btn-xs btn-icon'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('admin.varians.edit', $id) }}" class='btn btn-outline-primary btn-xs btn-icon'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-outline-danger btn-xs btn-icon',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
{{-- </div> --}}
{!! Form::close() !!}
