
 <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="id-tab" data-toggle="tab" href="#idtab" role="tab" aria-controls="idtab" aria-selected="true">Indonesia</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="en-tab" data-toggle="tab" href="#entab" role="tab" aria-controls="entab" aria-selected="false">English</a>
  </li>
</ul>

<div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
  <div class="tab-pane fade show active" id="idtab" role="tabpanel" aria-labelledby="id-tab">
    <!-- tab1 -->

            <!-- Title Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('title', 'Title:', ['class' => 'd-block']) !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

                    <!-- Content Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('description', 'Description:', ['class' => 'd-block']) !!}
                <textarea name="description" class="form-control my-editor">{!! old('description', isset($document) ? $document->description : '') !!}</textarea>
            </div>

            <!-- preview Field -->     
            <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('preview', 'Preview:') !!}
                <div id="picture-thumb">
                <img id="holder" src="{{ isset($document) ? $document->preview : '' }}" style="padding:10px;max-width:600px;max-height:300px">
                </div>
                <div class="input-group">
                <input class="form-control" type="text" id="preview" name="preview" value="{{ old('preview', isset($document) ? $document->preview : '') }}">
            <span class="input-group-append">
                <a id="lfm1" data-input="preview" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-file"></i> Choose
                </a>
                </span>
            </div>
            </div>
            <p class="tx-pink">* file jpg/jpeg/png, Ukuran : 700px x 500px</p>

            <!-- filename Field -->     
            <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('filename', 'Filename:') !!}
                <div class="input-group">
                <input class="form-control" type="text" id="filename" name="filename" value="{{ old('filename', isset($document) ? $document->filename : '') }}">
            <span class="input-group-append">
                <a id="lfm" data-input="filename" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-file"></i> Choose
                </a>
                </span>
            </div>
            </div>
    </div>
    <div class="tab-pane fade show active" id="entab" role="tabpanel" aria-labelledby="en-tab">
    <!-- tab1 -->

            <!-- Title Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('title_en', 'Title [EN]:', ['class' => 'd-block']) !!}
                {!! Form::text('title_en', null, ['class' => 'form-control']) !!}
            </div>

                                <!-- Content Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('description_en', 'Description [EN]:', ['class' => 'd-block']) !!}
                <textarea name="description_en" class="form-control my-editor">{!! old('description_en', isset($document) ? $document->description_en : '') !!}</textarea>
            </div>

            <!-- preview Field -->     
            <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('preview_en', 'Preview [EN]:') !!}
                <div id="picture-thumb">
                <img id="holder_en" src="{{ isset($document) ? $document->preview_en : '' }}" style="padding:10px;max-width:600px;max-height:300px">
                </div>
                <div class="input-group">
                <input class="form-control" type="text" id="preview_en" name="preview_en" value="{{ old('preview_en', isset($document) ? $document->preview_en : '') }}">
            <span class="input-group-append">
                <a id="lfm2" data-input="preview_en" data-preview="holder_en" class="btn btn-primary text-white">
                    <i class="fa fa-file"></i> Choose
                </a>
                </span>
            </div>
            </div>
            <p class="tx-pink">* file jpg/jpeg/png, Ukuran : 700px x 500px</p>

            <!-- filename Field -->     
            <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('filename_en', 'Filename [EN]:') !!}
                <div class="input-group">
                <input class="form-control" type="text" id="filename_en" name="filename_en" value="{{ old('filename_en', isset($document) ? $document->filename_en : '') }}">
            <span class="input-group-append">
                <a id="lfm3" data-input="filename_en" data-preview="holder_en" class="btn btn-primary text-white">
                    <i class="fa fa-file"></i> Choose
                </a>
                </span>
            </div>
            </div>
    </div>
    </div>
<br/>
<!-- Site Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('site', 'Site:', ['class' => 'd-block']) !!}
    {!! Form::text('site', null, ['class' => 'form-control']) !!}
</div> -->

<!-- Url Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:', ['class' => 'd-block']) !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div> -->

<!-- From Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('published_at', 'Published Date:') !!}
    {!! Form::date('published_at', old('published_at', isset($document) ? $document->published_at : '') , ['class' => 'form-control date']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::select('category', $jenis->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $status->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.documents.index') !!}" class="btn btn-light">Cancel</a>
</div>

@section('scripts')
<!-- Relational Form table -->
<script>
    $('.btn-add-related').on('click', function() {
        var relation = $(this).data('relation');
        var index = $(this).parents('.panel').find('tbody tr').length - 1;

        if($('.empty-data').length) {
            $('.empty-data').hide();
        }

        // TODO: edit these related input fields (input type, option and default value)
        var inputForm = '';
        var fields = $(this).data('fields').split(',');
        // $.each(fields, function(idx, field) {
        //     inputForm += `
        //         <td class="form-group">
        //             {!! Form::select('`+relation+`[`+relation+index+`][`+field+`]', [], null, ['class' => 'form-control select2', 'style' => 'width:100%']) !!}
        //         </td>
        //     `;
        // })
        $.each(fields, function(idx, field) {
            inputForm += `
                <td class="form-group">
                    {!! Form::text('`+relation+`[`+relation+index+`][`+field+`]', null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
            `;
        })

        var relatedForm = `
            <tr id="`+relation+index+`">
                `+inputForm+`
                <td class="form-group" style="text-align:right">
                    <button type="button" class="btn-delete btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
        `;

        $(this).parents('.panel').find('tbody').append(relatedForm);

        $('#'+relation+index+' .select2').select2();
    });

    $(document).on('click', '.btn-delete', function() {
        var actionDelete = confirm('Are you sure?');
        if(actionDelete) {
            var dom;
            var id = $(this).data('id');
            var relation = $(this).data('relation');

            if(id) {
                dom = `<input class="`+relation+`-delete" type="hidden" name="`+relation+`-delete[]" value="` + id + `">`;
                $(this).parents('.box-body').append(dom);
            }

            $(this).parents('tr').remove();

            if(!$('tbody tr').length) {
                $('.empty-data').show();
            }
        }
    });
</script>
<!-- End Relational Form table -->
@endsection
