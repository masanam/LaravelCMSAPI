@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Category
        </h1>--}}

        {{--@include('admin.categories.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Category</h4>

        <div data-label="Show" class="df-example demo-forms categories-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.categories.show_fields')
                        <a href="{!! route('admin.categories.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
