@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h3>
            Profile
        </h3> --}}

        {{--@include('profiles.version')--}}
    {{-- </section> --}}
    <div class="content">
        @include('flash::message')

        @include('adminlte-templates::common.errors')

        <h4>Profile</h4>

        <div data-label="Edit" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row"> --}}
                        {!! Form::model($profile, ['route' => ['profiles.update', $profile->id], 'method' => 'patch']) !!}

                                @include('profiles.fields')

                        {!! Form::close() !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
