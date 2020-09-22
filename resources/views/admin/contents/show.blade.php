@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Content
        </h1>--}}

        {{--@include('admin.contents.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Content</h4>

        <div data-label="Show" class="df-example demo-forms contents-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.contents.show_fields')
                        <a href="{!! route('admin.contents.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
