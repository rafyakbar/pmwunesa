<div class="card">
    <div class="card-header">
        <h4>Informasi Umum</h4>
    </div>

    <div class="card-content">
        <div class="row">
            <div class="col-lg-4">
                <strong>Judul</strong>
            </div>
            <div class="col-lg-8">
                {{ $proposal->judul }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <strong>Jenis Produk</strong>
            </div>
            <div class="col-lg-7">
                {{ $proposal->jenis_usaha }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <strong>Usulan Dana</strong>
            </div>
            <div class="col-lg-8">
                {{ Dana::format($proposal->usulan_dana) }}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <strong>Judul</strong>
            </div>
            <div class="col-lg-8">
                {{ $proposal->judul }}
            </div>
        </div>

        @if(!Auth::user()->isMahasiswa())
            <hr style="margin: 20px 0 5px"/>
            <h6 style="margin: 5px;font-weight:bold">Informasi Pengusul</h6>
            <hr style="margin: 5px"/>
            <ol style="padding: 10px">
                @foreach ($anggota->cursor() as $value)
                    <li>{{ $value->pengguna()->nama }} {!! $value->pengguna()->nama == $ketua->nama ? '<b>(Ketua)</b>' : '' !!}</li>
                @endforeach
            </ol>
        @endif

        @if(Auth::user()->isKetua())
            <a href="{{ route('edit.proposal') }}" class="btn btn-warning btn-sm">Edit Proposal</a>
        @endif
    </div>
</div>
