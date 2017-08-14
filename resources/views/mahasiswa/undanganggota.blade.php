@extends('layouts.app')

@section('content')
    {{--@if(Auth::user()->mahasiswa()->bisaKirimUndanganTim())--}}

    <div class="card">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-6">
                <div class="form-group">
                    <form class="card-content" action="{{ route('cari.mahasiswa') }}" method="get" id="cari-anggota">

                        <input class="form-control" type="text" name="nama" placeholder="Cari Mahasiswa" />

                        <button class="btn btn-primary btn-sm" type="submit" style="float: right; font-size: 14px">Cari</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="card-header" data-background-color="blue" style="margin-top: 10px">
            <h4>Hasil Pencarian</h4>
        </div>
        <div class="card-content table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama</th>
                            <th>Fakultas</th>
                            <th>Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. </td>
                            <td>Namanya</td>
                            <td>Fakultasnya</td>
                            <td>Prodinya</td>
                            <td><button class="btn btn-primary btn-sm">Undang</button></td>
                        </tr>
                        <tr>
                            <td>2. </td>
                            <td>Namanya</td>
                            <td>Fakultasnya</td>
                            <td>Prodinya</td>
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
                        btn.attr('class', 'undang-anggota btn btn-primary')
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
                            //var daftar = JSON.parse(response)
                            hasilPencarian.text('')
                            for (value in response) {
                                hasilPencarian.append(response[value].nama + '  ')
                                hasilPencarian.append(undangButton(response[value].id)).append('<br/>')
                                console.log(undangButton(response[value].id))
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