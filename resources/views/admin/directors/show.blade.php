@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Director
        </h1>--}}

        {{--@include('admin.directors.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Director</h4>

        <div data-label="Show" class="df-example demo-forms directors-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.directors.show_fields')
                        <a href="{!! route('admin.directors.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
