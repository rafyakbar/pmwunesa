<div class="card">
    <div class="card-header">
        <h4>Tim Anda</h4>
    </div>
    <div class="card-content">
        <ul>
            @foreach(Auth::user()->mahasiswa()->proposal()->mahasiswa()->cursor() as $anggota)
                <li>{{ $anggota->pengguna()->nama }} {!! $anggota->pengguna()->isKetua() ? '<b>(Ketua)</b>' : '' !!}</li>
            @endforeach
        </ul>
    </div>
</div>