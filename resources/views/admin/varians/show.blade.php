@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Varian
        </h1>--}}

        {{--@include('admin.varians.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Varian</h4>

        <div data-label="Show" class="df-example demo-forms varians-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.varians.show_fields')
                        <a href="{!! route('admin.varians.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
