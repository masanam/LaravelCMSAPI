@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Registrant
        </h1>--}}

        {{--@include('admin.registrants.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Registrant</h4>

        <div data-label="Show" class="df-example demo-forms registrants-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.registrants.show_fields')
                        <a href="{!! route('admin.registrants.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
