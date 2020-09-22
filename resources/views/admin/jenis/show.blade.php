@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Jenis
        </h1>--}}

        {{--@include('admin.jenis.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Jenis</h4>

        <div data-label="Show" class="df-example demo-forms jenis-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.jenis.show_fields')
                        <a href="{!! route('admin.jenis.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
