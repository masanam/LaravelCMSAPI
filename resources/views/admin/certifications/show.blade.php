@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Certification
        </h1>--}}

        {{--@include('admin.certifications.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Certification</h4>

        <div data-label="Show" class="df-example demo-forms certifications-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.certifications.show_fields')
                        <a href="{!! route('admin.certifications.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
