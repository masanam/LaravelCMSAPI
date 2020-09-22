@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Menu
        </h1>--}}

        {{--@include('admin.menus.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Menu</h4>

        <div data-label="Show" class="df-example demo-forms menus-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.menus.show_fields')
                        <a href="{!! route('admin.menus.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
