@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Composition
        </h1>--}}

        {{--@include('admin.compositions.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Composition</h4>

        <div data-label="Show" class="df-example demo-forms compositions-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.compositions.show_fields')
                        <a href="{!! route('admin.compositions.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
