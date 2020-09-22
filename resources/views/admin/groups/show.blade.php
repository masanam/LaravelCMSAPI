@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Group
        </h1>--}}

        {{--@include('admin.groups.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Group</h4>

        <div data-label="Show" class="df-example demo-forms groups-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.groups.show_fields')
                        <a href="{!! route('admin.groups.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
