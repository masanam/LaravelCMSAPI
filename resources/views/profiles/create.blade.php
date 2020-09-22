@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h3>
            Profile
        </h3> --}}

        {{--@include('profiles.version')--}}
    {{-- </section> --}}
    <div class="content">
        @include('adminlte-templates::common.errors')

        <h4>Profile</h4>

        <div data-label="Create" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row"> --}}
                        {!! Form::open(['route' => 'profiles.store']) !!}

                            @include('profiles.fields')

                        {!! Form::close() !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
