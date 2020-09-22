@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Release
        </h1>--}}

        {{--@include('admin.releases.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Release</h4>

        <div data-label="Show" class="df-example demo-forms releases-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.releases.show_fields')
                        <a href="{!! route('admin.releases.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
