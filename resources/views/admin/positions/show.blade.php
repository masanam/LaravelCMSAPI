@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Position
        </h1>--}}

        {{--@include('admin.positions.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Position</h4>

        <div data-label="Show" class="df-example demo-forms positions-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.positions.show_fields')
                        <a href="{!! route('admin.positions.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
