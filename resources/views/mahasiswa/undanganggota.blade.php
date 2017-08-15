@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Undangan yang sedang dikirim</h4>
                </div>
                <div class="card-content">
                    @if(Auth::user()->mahasiswa()->undanganTimKetua()->count() > 0)
                        @foreach (Auth::user()->mahasiswa()->undanganTimKetua() as $undangan)
                            <p>{{ $undangan }}</p>
                        @endforeach
                    @else
                        <p class="alert alert-warning">Maaf, anda belum mengirim undangan ke siapapun</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <form class="card" action="{{ route('cari.mahasiswa') }}" method="get" id="cari-anggota">

                <input  type="text" name="nama" placeholder="Cari Mahasiswa" autofocus/>

                <button type="submit"><i class="fa fa-search"></i></button>

            </form>

            <div class="card">
                <div class="card-header" data-background-color="blue">
                    <h4>Hasil Pencarian</h4>
                </div>
                <div class="card-content table-responsive">
                    <div id="belum-cari" style="text-align:center;">
                        <i class="fa fa-user fa-5x"></i>
                        <p style="font-size:30px;padding-top:10px;">Mulailah untuk mencari anggota timmu</p>
                    </div>
                    <div id="not-found" style="text-align:center;display:none">
                        <i class="fa fa-user-times fa-5x"></i>
                        <p style="font-size:30px;padding-top:10px;">Tidak menemukan user yang anda cari</p>
                    </div>
                    <table class="table table-striped" style="display:none">
                        <thead>
                            <tr class="text-default">
                                <th>Nama</th>
                                <th>Asal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="hasil-pencarian">
                            <tr>
                                <td>Namanya</td>
                                <td>Fakultasnya</td>
                                <td><button class="btn btn-primary btn-sm">Undang</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="hasil-pencarian"></div>
                    <form action="{{ route('undang.anggota') }}" method="post" style="display: none" id="undang-anggota">
                        {{ csrf_field() }}
                        <input type="hidden" name="untuk" />
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- <form action="{{ route('cari.mahasiswa') }}" method="get" id="cari-anggota">

    <input type="text" name="nama"/>

    <input type="submit" value="cari"/>

</form> -->

@push('js')
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script type="text/javascript">
    $(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        })

        var inputCari = $('#cari-anggota')

        var undangAnggota = $('#undang-anggota')

        var hasilPencarian = $('#hasil-pencarian')

        undangButton = function (id) {
            var btn = $('<button></button>')
            btn.attr('id', id)
            btn.attr('class', 'undang-anggota btn btn-primary btn-sm')
            btn.text('undang')
            btn.click(function (e) {
                e.preventDefault()
                id = $(this).attr('id')
                undangAnggota.find('input[name="untuk"]').val(id)
                undangAnggota.submit();
            })

            return btn
        }

        inputCari.ajaxForm({
            success: function (response) {
                $('#belum-cari').hide()
                hasilPencarian.find('tr').remove()
                if(response.length == 0){
                    hasilPencarian.parent().hide()
                    $('#not-found').show()
                }
                else{
                    $('#not-found').hide()
                    hasilPencarian.parent().show()
                for (value in response) {
                    var baris = $('<tr></tr>')
                    var nama = $('<td></td>').text(response[value].nama)
                    var asal = $('<td></td>').text('asal')
                    var aksi = undangButton(response[value].id)
                    baris.append(nama)
                    baris.append(asal)
                    baris.append(aksi)
                    hasilPencarian.append(baris)
                    // var fakultas = $('<td></td>').text(response[value].id)
                }
            }
            }
        });

        inputCari.find('input[type="text"]').on('keyup', function () {
            if ($(this).val() !== '')
            $(this).parent().submit()
        })

        undangAnggota.ajaxForm({
            success : function (response) {
                alert(response.message)
            }
        })
    })
    </script>
@endpush
{{--@endif--}}
@endsection
