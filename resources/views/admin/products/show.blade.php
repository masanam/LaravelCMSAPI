@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Product
        </h1>--}}

        {{--@include('admin.products.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Product</h4>

        <div data-label="Show" class="df-example demo-forms products-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.products.show_fields')
                        <a href="{!! route('admin.products.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
