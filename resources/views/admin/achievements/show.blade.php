@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Achievement
        </h1>--}}

        {{--@include('admin.achievements.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Achievement</h4>

        <div data-label="Show" class="df-example demo-forms achievements-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.achievements.show_fields')
                        <a href="{!! route('admin.achievements.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
