@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            User
        </h1> --}}

        {{--@include('users.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>User</h4>

        <div data-label="Show" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('users.show_fields')
                        <a href="{!! route('users.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
