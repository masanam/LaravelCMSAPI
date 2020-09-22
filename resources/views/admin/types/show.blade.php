@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Type
        </h1>--}}

        {{--@include('admin.types.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Type</h4>

        <div data-label="Show" class="df-example demo-forms types-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.types.show_fields')
                        <a href="{!! route('admin.types.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
