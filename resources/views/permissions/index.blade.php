@extends('layouts.app')

@section('contents')
    @include('flash::message')

    <section class="content-header">
        <h4 class="pull-left">Permissions</h4>
        <div class="pull-right">
            {{-- <button type="button" class="btn btn-info btn-sm btn-uppercase pull-right" style="margin-right: 5px" data-toggle="modal" data-target="#myModal">
                Import Excel File
            </button> --}}
            <a class="btn btn-primary btn-sm btn-uppercase pull-right" href="{!! route('permissions.create') !!}"><i class="fa fa-plus"></i> Add New</a>
        </div>
    </section>
    <div class="content">
        {{-- <div data-label="Create Form" class="df-example demo-forms"> --}}
            <div class="box box-primary">
                <div class="box-body">
                    @include('permissions.table')
                </div>
            </div>
        {{-- </div> --}}
    </div>

    <!-- Modal -->
    {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="modal-content" action="{!! url('importPermission') !!}" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Data Import</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group col-sm-12">
                        <label for="import">Data:</label>
                        <input id="import" class="form-control" type="file" name="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>--}}
@endsection

