@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Announcement
        </h1>--}}

        {{--@include('admin.announcements.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Announcement</h4>

        <div data-label="Show" class="df-example demo-forms announcements-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.announcements.show_fields')
                        <a href="{!! route('admin.announcements.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
