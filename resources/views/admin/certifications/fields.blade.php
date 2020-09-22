<!-- Issuer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('issuer', 'Issuer:', ['class' => 'd-block']) !!}
    {!! Form::text('issuer', null, ['class' => 'form-control']) !!}
</div>

<!-- Issuer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('year', 'Year:', ['class' => 'd-block']) !!}
    {!! Form::text('year', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:', ['class' => 'd-block']) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Seotitle Field -->
<!-- <div class="form-group col-sm-6">
    {!! Form::label('seotitle', 'Seotitle:', ['class' => 'd-block']) !!}
    {!! Form::text('seotitle', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
</div> -->

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Description:', ['class' => 'd-block']) !!}
    <textarea name="content" class="form-control my-editor">{!! old('content', isset($certification) ? $certification->content : '') !!}</textarea>
</div>

 <!-- Picture Field -->     
 <div class="form-group col-sm-12 col-lg-12">
 {!! Form::label('picture', 'Picture:') !!}
    <div id="picture-thumb">
    <img id="holder" src="{{ isset($certification) ? $certification->picture : '' }}" style="padding:10px;max-width:600px;max-height:300px">
    </div>
	<div class="input-group">
    <input class="form-control" type="text" id="picture" name="picture" value="{{ old('picture', isset($certification) ? $certification->picture : '') }}">
   <span class="input-group-append">
     <a id="lfm" data-input="picture" data-preview="holder" class="btn btn-primary text-white">
        <i class="fa fa-file"></i> Choose
     </a>
     </span>
   </div>
 </div>
 <p class="tx-pink">* file jpg/jpeg/png, Ukuran : 690px x 460px</p>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $status->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.certifications.index') !!}" class="btn btn-light">Cancel</a>
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
