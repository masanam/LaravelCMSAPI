@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Permission
        </h1>--}}

        {{--@include('admin.permissions.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Permission</h4>

        <div data-label="Show" class="df-example demo-forms permissions-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.permissions.show_fields')
                        <a href="{!! route('admin.permissions.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
