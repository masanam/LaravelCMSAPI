@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Contact
        </h1>--}}

        {{--@include('admin.contacts.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Contact</h4>

        <div data-label="Show" class="df-example demo-forms contacts-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.contacts.show_fields')
                        <a href="{!! route('admin.contacts.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
