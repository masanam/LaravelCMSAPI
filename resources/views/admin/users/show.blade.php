@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Users
        </h1>--}}

        {{--@include('admin.users.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Users</h4>

        <div data-label="Show" class="df-example demo-forms users-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.users.show_fields')
                        <a href="{!! route('admin.users.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
