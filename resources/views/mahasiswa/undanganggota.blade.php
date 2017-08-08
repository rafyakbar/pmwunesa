@extends('layouts.app')

@section('content')
    {{--@if(Auth::user()->mahasiswa()->bisaKirimUndanganTim())--}}

        <form action="{{ route('cari.mahasiswa') }}" method="get" id="cari-anggota">

            <input type="text" name="nama"/>

            <input type="submit" value="cari"/>

        </form>

        <div id="hasil-pencarian"></div>

        <form action="{{ route('undang.anggota') }}" method="post" style="display: none" id="undang-anggota">
            {{ csrf_field() }}
            <input type="hidden" name="untuk"/>
        </form>

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
                        btn.attr('class', 'undang-anggota')
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