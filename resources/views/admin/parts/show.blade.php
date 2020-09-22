@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Part
        </h1>--}}

        {{--@include('admin.parts.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Part</h4>

        <div data-label="Show" class="df-example demo-forms parts-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.parts.show_fields')
                        <a href="{!! route('admin.parts.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
