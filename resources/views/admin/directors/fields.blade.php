<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Category:', ['class' => 'd-block']) !!}
    {!! Form::select('category_id', $category->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fullname', 'Fullname:', ['class' => 'd-block']) !!}
    {!! Form::text('fullname', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
{!! Form::label('title', 'Jabatan:') !!}
 <select class="form-control select2" name="title">
    @if (isset($director))
            <option value="1" {{ ( $director->title == '1') ? 'selected' : '' }}> Other </option>
            <option value="2" {{ ( $director->title == '2') ? 'selected' : '' }}> Ketua </option>
            <option value="3" {{ ( $director->title == '3') ? 'selected' : '' }}> Anggota </option>
            @else
            <option value="1"> Other </option>
            <option value="2"> Ketua </option>
            <option value="3"> Anggota </option>
            @endif
    </select>    
    </div> 

 <!-- Picture Field -->     
 <div class="form-group col-sm-12 col-lg-12">
 {!! Form::label('picture', 'Picture:') !!}
    <div id="picture-thumb">
    <img id="holder" src="{{ isset($director) ? $director->picture : '' }}" style="padding:10px;max-width:600px;max-height:300px">
    </div>
	<div class="input-group">
    <input class="form-control" type="text" id="picture" name="picture" value="{{ old('picture', isset($director) ? $director->picture : '') }}">
   <span class="input-group-append">
     <a id="lfm" data-input="picture" data-preview="holder" class="btn btn-primary text-white">
        <i class="fa fa-file"></i> Choose
     </a>
     </span>
   </div>
 </div>
 <p class="tx-pink">* file jpg/jpeg/png, Ukuran : 700px x 500px</p>

<!-- Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sortby', 'Orderid:', ['class' => 'd-block']) !!}
    {!! Form::text('sortby', null, ['class' => 'form-control']) !!}
</div>

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
            
        <!-- Position Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('position', 'Position:', ['class' => 'd-block']) !!}
            {!! Form::text('position', null, ['class' => 'form-control']) !!}
        </div>
        <!-- Citizen Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('citizen', 'Citizenship:', ['class' => 'd-block']) !!}
            {!! Form::text('citizen', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Age Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('age', 'Age:', ['class' => 'd-block']) !!}
            {!! Form::text('age', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Education Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('education', 'Educational Background:', ['class' => 'd-block']) !!}
            <textarea name="education" class="form-control my-editor">{!! old('education', isset($director) ? $director->education : '') !!}</textarea>

        </div>

        <!-- Legal Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('legal', 'Legal Basis for Appointment:', ['class' => 'd-block']) !!}
            <textarea name="legal" class="form-control my-editor">{!! old('legal', isset($director) ? $director->legal : '') !!}</textarea>

        </div>

        <!-- Experience Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('experience', 'Working Experiences:', ['class' => 'd-block']) !!}
            <textarea name="experience" class="form-control my-editor">{!! old('experience', isset($director) ? $director->experience : '') !!}</textarea>
        </div>

        <!-- Concurrent Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('concurrent', 'Concurrent Position:', ['class' => 'd-block']) !!}
            <textarea name="concurrent" class="form-control my-editor">{!! old('concurrent', isset($director) ? $director->concurrent : '') !!}</textarea>
        </div>

        <!-- Affiliate Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('affiliate', 'Affiliated Relationship:', ['class' => 'd-block']) !!}
            <textarea name="affiliate" class="form-control my-editor">{!! old('affiliate', isset($director) ? $director->affiliate : '') !!}</textarea>
        </div>

        <!-- Desciption Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description', 'Desciption:', ['class' => 'd-block']) !!}
            <textarea name="description" class="form-control my-editor">{!! old('description', isset($director) ? $director->description : '') !!}</textarea>
        </div>

                <!-- Age Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('noted', 'Noted:', ['class' => 'd-block']) !!}
            {!! Form::text('noted', null, ['class' => 'form-control']) !!}
        </div>

        </div>
    <div class="tab-pane fade show active" id="entab" role="tabpanel" aria-labelledby="en-tab">
    <!-- tab1 -->
        
        <!-- Position Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('position_en', 'Position [EN]:', ['class' => 'd-block']) !!}
            {!! Form::text('position_en', null, ['class' => 'form-control']) !!}
        </div>
        <!-- Citizen Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('citizen_en', 'Citizenship [EN] :', ['class' => 'd-block']) !!}
            {!! Form::text('citizen_en', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Age Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('age_en', 'Age [EN]:', ['class' => 'd-block']) !!}
            {!! Form::text('age_en', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Education Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('education_en', 'Educational Background [EN]:', ['class' => 'd-block']) !!}
            <textarea name="education_en" class="form-control my-editor">{!! old('education_en', isset($director) ? $director->education_en : '') !!}</textarea>

        </div>

        <!-- Legal Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('legal_en', 'Legal Basis for Appointment [EN]:', ['class' => 'd-block']) !!}
            <textarea name="legal_en" class="form-control my-editor">{!! old('legal_en', isset($director) ? $director->legal_en : '') !!}</textarea>

        </div>

        <!-- Experience Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('experience_en', 'Working Experiences [EN]:', ['class' => 'd-block']) !!}
            <textarea name="experience_en" class="form-control my-editor">{!! old('experience_en', isset($director) ? $director->experience_en : '') !!}</textarea>
        </div>

        <!-- Concurrent Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('concurrent_en', 'Concurrent Position [EN]:', ['class' => 'd-block']) !!}
            <textarea name="concurrent_en" class="form-control my-editor">{!! old('concurrent_en', isset($director) ? $director->concurrent_en : '') !!}</textarea>
        </div>

        <!-- Affiliate Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('affiliate_en', 'Affiliated Relationship [EN]:', ['class' => 'd-block']) !!}
            <textarea name="affiliate_en" class="form-control my-editor">{!! old('affiliate_en', isset($director) ? $director->affiliate_en : '') !!}</textarea>
        </div>

        <!-- Desciption Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description_en', 'Desciption [EN]:', ['class' => 'd-block']) !!}
            <textarea name="description_en" class="form-control my-editor">{!! old('description_en', isset($director) ? $director->description_en : '') !!}</textarea>
        </div>
        <!-- Age Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('noted_en', 'Noted [EN]:', ['class' => 'd-block']) !!}
            {!! Form::text('noted_en', null, ['class' => 'form-control']) !!}
        </div>        </div>
</div>    
<br/>   
<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $status->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.directors.index') !!}" class="btn btn-light">Cancel</a>
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
