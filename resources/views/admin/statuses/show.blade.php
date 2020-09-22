@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Status
        </h1>--}}

        {{--@include('admin.statuses.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Status</h4>

        <div data-label="Show" class="df-example demo-forms statuses-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.statuses.show_fields')
                        <a href="{!! route('admin.statuses.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
