@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Brand
        </h1>--}}

        {{--@include('admin.brands.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Brand</h4>

        <div data-label="Show" class="df-example demo-forms brands-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.brands.show_fields')
                        <a href="{!! route('admin.brands.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
