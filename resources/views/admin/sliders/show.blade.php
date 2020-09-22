@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Slider
        </h1>--}}

        {{--@include('admin.sliders.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Slider</h4>

        <div data-label="Show" class="df-example demo-forms sliders-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.sliders.show_fields')
                        <a href="{!! route('admin.sliders.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
