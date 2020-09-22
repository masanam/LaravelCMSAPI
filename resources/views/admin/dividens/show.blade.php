@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Dividen
        </h1>--}}

        {{--@include('admin.dividens.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Dividen</h4>

        <div data-label="Show" class="df-example demo-forms dividens-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.dividens.show_fields')
                        <a href="{!! route('admin.dividens.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
