@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Section
        </h1>--}}

        {{--@include('admin.sections.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Section</h4>

        <div data-label="Show" class="df-example demo-forms sections-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.sections.show_fields')
                        <a href="{!! route('admin.sections.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
