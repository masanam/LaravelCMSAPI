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

        <div data-label="Create" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row"> --}}
                        {!! Form::open(['route' => 'roles.store']) !!}

                            @include('roles.fields')

                        {!! Form::close() !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
