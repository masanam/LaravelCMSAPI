@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Document
        </h1>--}}

        {{--@include('admin.documents.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Document</h4>

        <div data-label="Show" class="df-example demo-forms documents-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.documents.show_fields')
                        <a href="{!! route('admin.documents.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
