@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Career
        </h1>--}}

        {{--@include('admin.careers.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Career</h4>

        <div data-label="Show" class="df-example demo-forms careers-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.careers.show_fields')
                        <a href="{!! route('admin.careers.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
