@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Testimony
        </h1>--}}

        {{--@include('admin.testimonies.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Testimony</h4>

        <div data-label="Show" class="df-example demo-forms testimonies-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.testimonies.show_fields')
                        <a href="{!! route('admin.testimonies.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection