@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Share
        </h1>--}}

        {{--@include('admin.shares.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Share</h4>

        <div data-label="Show" class="df-example demo-forms shares-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.shares.show_fields')
                        <a href="{!! route('admin.shares.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
