@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Distribution
        </h1>--}}

        {{--@include('admin.distributions.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Distribution</h4>

        <div data-label="Show" class="df-example demo-forms distributions-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.distributions.show_fields')
                        <a href="{!! route('admin.distributions.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
