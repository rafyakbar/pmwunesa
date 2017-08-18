<div class="row">
    <div class="col-lg-6">
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
    </div>

    <div class="col-lg-6">
        @if(Auth::user()->mahasiswa()->proposal()->punyaPembimbing())
            <div class="card">
                <div class="card-header">
                    <h4>Dosen Pembimbing</h4>
                </div>
                <div class="card-content">
                    {{ Auth::user()->mahasiswa()->proposal()->pembimbing() }}
                </div>
            </div>
        @else
            @include('mahasiswa.part.pencarian_pembimbing')
        @endif
    </div>
</div>
