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
            {!! Form::label('content', 'Content:', ['class' => 'd-block']) !!}
            <textarea name="content" class="form-control my-editor">{!! old('content', isset($content) ? $content->content : '') !!}</textarea>
        </div>
        </div>
    <div class="tab-pane fade show active" id="entab" role="tabpanel" aria-labelledby="en-tab">
    <!-- tab1 -->


        <div class="form-group col-sm-6">
        {!! Form::label('title_en', 'Title [EN]:', ['class' => 'd-block']) !!}
            {!! Form::text('title_en', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('content_en', 'Content [EN]:', ['class' => 'd-block']) !!}
            <textarea name="content_en" class="form-control my-editor">{!! old('content_en', isset($content) ? $content->content_en : '') !!}</textarea>
        </div>
        </div>
</div>    
<br/>     
<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', $category->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

 <!-- Picture Field -->     
 <div class="form-group col-sm-12 col-lg-12">
 {!! Form::label('picture', 'Picture:') !!}
    <div id="picture-thumb">
    <img id="holder" src="{{ isset($content) ? $content->picture : '' }}" style="padding:10px;max-width:600px;max-height:300px">
    </div>
	<div class="input-group">
    <input class="form-control" type="text" id="picture" name="picture" value="{{ old('picture', isset($content) ? $content->picture : '') }}">
   <span class="input-group-append">
     <a id="lfm" data-input="picture" data-preview="holder" class="btn btn-primary text-white">
        <i class="fa fa-file"></i> Choose
     </a>
     </span>
   </div>
 </div>
 <p class="tx-pink">* file jpg/jpeg/png, Ukuran : 690px x 460px</p>

<!-- Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag', 'Tags:', ['class' => 'd-block']) !!}
    {!! Form::text('tag', null, ['class' => 'form-control', 'data-role' => 'tagsinput']) !!}
    <p class="tx-pink">* separate with comma</p>

</div>

@if (isset($content))
    <div class="form-group col-sm-6">
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" value="1" name="headline" id="customCheck1" {{ $content->headline == '1' ? 'checked' : '' }}>
        <label class="custom-control-label" for="customCheck1">Headline</label>
        </div>
    </div>
@else
    <div class="form-group col-sm-6">
        <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" value="1" name="headline" id="customCheck1">
        <label class="custom-control-label" for="customCheck1">Headline</label>
        </div>
</div>
@endif

<!-- From Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('published_at', 'Published Date:') !!}
    {!! Form::date('published_at', old('published_at', isset($content) ? $content->published_at : '') , ['class' => 'form-control date']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $status->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.contents.index') !!}" class="btn btn-light">Cancel</a>
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
