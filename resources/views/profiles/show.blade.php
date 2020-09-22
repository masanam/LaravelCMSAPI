@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Profile
        </h1> --}}

        {{--@include('profiles.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Profile</h4>

        <div data-label="Show" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('profiles.show_fields')
                        <a href="{!! route('profiles.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
