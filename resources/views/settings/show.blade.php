@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Setting
        </h1>--}}

        {{--@include('settings.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Setting</h4>

        <div data-label="Show" class="df-example demo-forms settings-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('settings.show_fields')
                        <a href="{!! route('settings.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
