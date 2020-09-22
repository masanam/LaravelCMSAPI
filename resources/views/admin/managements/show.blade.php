@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Management
        </h1>--}}

        {{--@include('admin.managements.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Management</h4>

        <div data-label="Show" class="df-example demo-forms managements-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.managements.show_fields')
                        <a href="{!! route('admin.managements.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
