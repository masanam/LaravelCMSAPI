@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Milestone
        </h1>--}}

        {{--@include('admin.milestones.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Milestone</h4>

        <div data-label="Show" class="df-example demo-forms milestones-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.milestones.show_fields')
                        <a href="{!! route('admin.milestones.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
