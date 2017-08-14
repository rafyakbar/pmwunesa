@extends('layouts.app')

@section('content')

@section('brand', "Logbook")

<h2>Logbook</h2>

{{--@if(Auth::user()->mahasiswa()->proposal()->logbook()->count() > 0)
    @foreach(
        Auth::user()->mahasiswa()->proposal()->logbook()->get() as $logbook)
{{ $logbook }} <br/>
@endforeach--}}
@if(Auth::user()->isKetua())
<form action="{{ route('tambah.logbook') }}" method="post">

    {{ csrf_field() }} {{ method_field('put') }} Catatan

    <br/>
    <textarea name="catatan"></textarea><br/> Biaya

    <br/>
    <input type="number" name="biaya" /><br/>

    <input type="submit" value="Tambah" />

</form>
@endif {{--@else Anda belum memiliki logbook.<br/> @endif--}}

@if(Auth::user()->mahasiswa()->punyaProposal())
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-content table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal</th>
                            <th>Catatan</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->mahasiswa()->proposal()->logbook()->cursor() as $index => $logbook)

                        @endforeach
                        <tr>
                            <td>{{ $index }}</td>
                            <td>{{ $logbook->created_at }}</td>
                            <td>{{ $logbook->catatan }}</td>
                            <td>{{ $logbook->biaya }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
