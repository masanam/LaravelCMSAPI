@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Ownership
        </h1>--}}

        {{--@include('admin.ownerships.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Ownership</h4>

        <div data-label="Show" class="df-example demo-forms ownerships-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.ownerships.show_fields')
                        <a href="{!! route('admin.ownerships.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
