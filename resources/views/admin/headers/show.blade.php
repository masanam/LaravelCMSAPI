@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Header
        </h1>--}}

        {{--@include('admin.headers.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Header</h4>

        <div data-label="Show" class="df-example demo-forms headers-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.headers.show_fields')
                        <a href="{!! route('admin.headers.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
