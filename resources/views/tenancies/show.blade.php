@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Tenancy
        </h1>--}}

        {{--@include('tenancies.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Tenancy</h4>

        <div data-label="Show" class="df-example demo-forms tenancies-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('tenancies.show_fields')
                        <a href="{!! route('tenancies.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
