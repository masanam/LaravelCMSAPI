@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h3>
            Permission
        </h3> --}}

        {{--@include('permissions.version')--}}
    {{-- </section> --}}
    <div class="content">
        @include('adminlte-templates::common.errors')

        <h4>Permission</h4>

        <div data-label="Edit" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row"> --}}
                        {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'patch']) !!}

                            @include('permissions.fields')

                        {!! Form::close() !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
