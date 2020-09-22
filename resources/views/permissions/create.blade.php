@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Permission
        </h1> --}}

        {{--@include('permissions.version')--}}
    {{-- </section> --}}
    <div class="content">
        <div class="container">
            @include('adminlte-templates::common.errors')

            <h4>Permission</h4>

            <div data-label="Create" class="df-example demo-forms">
                <div class="box box-primary">
                    <div class="box-body">
                        {{-- <div class="row"> --}}
                            {!! Form::open(['route' => 'permissions.store']) !!}

                                @include('permissions.fields')

                            {!! Form::close() !!}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
