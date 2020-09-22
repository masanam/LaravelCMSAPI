@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Investor
        </h1>--}}

        {{--@include('admin.investors.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Investor</h4>

        <div data-label="Show" class="df-example demo-forms investors-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.investors.show_fields')
                        <a href="{!! route('admin.investors.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
