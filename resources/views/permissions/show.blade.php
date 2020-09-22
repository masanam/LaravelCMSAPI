@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Permission
        </h1> --}}

        {{--@include('permissions.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Permission</h4>

        <div data-label="Show" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('permissions.show_fields')
                        <a href="{!! route('permissions.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
