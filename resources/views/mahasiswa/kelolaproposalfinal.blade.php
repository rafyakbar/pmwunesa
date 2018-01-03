@extends('layouts.app')

@if(isset($proposal))
    @section('brand','Edit Proposal Final')
    @section('title','Edit Proposal Final')
@else
    @section('brand','Unggah Proposal Final')
    @section('title','Unggah Proposal Final')
@endif

@section('content')
    <div class="card">

        <div class="card-header" data-background-color="blue">
            <h4>{{ isset($proposal) ? 'Edit' : 'Unggah' }} Proposal Final</h4>
        </div>

        <div class="card-content">
            <form action="{{ route('unggah.proposal.final') }}" method="post" enctype="multipart/form-data" id="unggah-proposal-final">

                {{ csrf_field() }}
    
                {{ method_field('put') }}
    
                <div class="form-group">
                    <label>Berkas Proposal</label><br>
                    <div class="input-group">
                        <button type="button" class="btn btn-primary">Pilih Berkas <input type="file" name="berkas"></button>
                    </div>
                </div>
    
                <button id="btn-unggah" type="submit" class="btn btn-success">Unggah Proposal Final</button>
    
            </form>

            <div class="progress" style="display:none" id="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuemin="0">
                        <span class="sr-only"></span>
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('js/jquery.form.js') }}" charset="utf-8"></script>
<script>
    $('#unggah-proposal-final').ajaxForm({
        beforeSend : function(){
            $('#progress').show()
            $('button[type="submit"]').attr('disabled','disabled').text('Sedang Mengunggah')
        },
        uploadProgress : function(event, position, total, percentComplete){
            $('#progress').find('.progress-bar').width(percentComplete + "%")
        },
        success : function(response){
            $('#progress').hide()
            $('#progress').find('.progress-bar').width("0%")
            swal({
                title : response.error ? 'Gagal !' : 'Berhasil !',
                type : response.error ? 'error' : 'success',
                text : response.message
            }, function() {
                if(!response.error)
                    window.location.replace(response.redirect)
            })
        },
        error : function(response){
            $('#btn-unggah').attr('disabled', 'false')
        }
    })
</script>
@endpush