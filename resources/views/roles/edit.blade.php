@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Role
        </h1> --}}

        {{--@include('roles.version')--}}
    {{-- </section> --}}
    <div class="content">
        @include('adminlte-templates::common.errors')

        <h4>Role</h4>

        <h4>Permission</h4>

        <div data-label="Edit" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row"> --}}
                        {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

                                @include('roles.fields')

                        {!! Form::close() !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
