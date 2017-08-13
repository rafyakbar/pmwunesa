@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/chooser.css') }}"/>
@endpush

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="title">Atur Reviewer Untuk <strong>{{ $proposal->judul }}</strong> </h4>
            <p class="category">Atur reviewer dari sebuah proposal tertentu</p>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col-lg-6">
                    <h5>Tahap 1</h5>
                    <form action="{{ route('edit.reviewer', ['idproposal' => $proposal->id]) }}" method="post" id="kelolatahap1">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <input type="hidden" name="tahap" value="1"/>
                        <input type="hidden" name="daftar_pengguna" value="{{ implode(',', $oldreviewer['tahap1']->pluck('pengguna.id')->toArray()) }}" id="tahap1"/>
                        <div class="chooser">
                            @foreach ($oldreviewer['tahap1']->get() as $reviewer)
                                <div class="choosed" data-index="{{ $reviewer->id }}">
                                    <span>{{ $reviewer->nama }}</span>
                                    <i class="fa fa-close close"></i>
                                </div>
                            @endforeach
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Pilih Reviewer</span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" data-target="#tahap1">
                                    <input type="text" class="form-control"/>
                                    @foreach ($daftarreviewer as $reviewer)
                                        <li id="{{ $reviewer->id }}" {{ in_array($reviewer->id, $oldreviewer['tahap1']->pluck('pengguna.id')->toArray()) ? 'style=display:none' : '' }}><a href="#">{{ $reviewer->nama }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h5>Tahap 2</h5>
                    <form action="{{ route('edit.reviewer',['idproposal' => $proposal->id]) }}" method="post" id="kelolatahap2">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        <input type="hidden" name="tahap" value="2"/>
                        <input type="hidden" name="daftar_pengguna" value="{{ implode(',', $oldreviewer['tahap2']->pluck('pengguna.id')->toArray()) }}" id="tahap2"/>
                        <div class="chooser">
                            @foreach ($oldreviewer['tahap2']->get() as $reviewer)
                                <div class="choosed" data-index="{{ $reviewer->id }}">
                                    <span>{{ $reviewer->nama }}</span>
                                    <i class="fa fa-close close"></i>
                                </div>
                            @endforeach
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span>Pilih Reviewer</span> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" data-target="#tahap2">
                                    <input type="text" class="form-control"/>
                                    @foreach ($daftarreviewer as $reviewer)
                                        <li id="{{ $reviewer->id }}" {{ in_array($reviewer->id, $oldreviewer['tahap2']->pluck('pengguna.id')->toArray()) ? 'style=display:none' : '' }}><a href="#">{{ $reviewer->nama }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-2 col-lg-offset-5">
                    <a class="btn btn-primary" style="width:100%" id="save">Simpan</a>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script>
    $(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('#kelolatahap1').ajaxForm({
        success : function(response){
            console.log('hello')
            $('#kelolatahap2').submit()
        }
    })

    $('#kelolatahap2').ajaxForm({
        success : function(response){

        }
    })

    $('#save').click(function(){
        $('#kelolatahap1').submit()
    })
    // Chooser
    $('.chooser').find('.dropdown-menu li').click(function(e){
        e.preventDefault()

        var btn = $(this).parent().parent()

        var dropdown = $(this).parent()

        var target =  $(dropdown.attr('data-target'))

        var val = target.val() == '' ? [] :  target.val().split(',')

        val.push($(this).attr('id'))

        target.val(val)

        console.log(val)

        btn.before('<div data-index="'+($(this).index()-1)+'" class="choosed"><span>' + $(this).text() + '</span><i class="fa fa-close close"></i></div>')

        $(this).hide()

        $('.chooser').find('.close').click(function(){

            var dropdown = $(this).parent().parent().find('.dropdown-menu')

            var li = $('#' + $(this).parent().attr('data-index'))

            li.show()

            var val = target.val().split(',')

            val.pop(li.attr('id'))

            target.val(val)

            console.log(val)

            $(this).parent().remove();
        })
    })
})
    </script>
@endpush
