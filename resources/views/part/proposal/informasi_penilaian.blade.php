<div class="card">
    <div class="card-header">
        <h4>Informasi Penilaian</h4>
    </div>
    <div class="card-content">
        <div class="row">
            <div class="col-lg-4">
                <strong>Status</strong>
            </div>
            <div class="col-lg-7">
                sfsdfdsf
            </div>
        </div>

        {{ $proposal->dalamProsesPenilaian(2) }}
        @if(Auth::user()->isMahasiswa() || $proposal->pembimbing()->id == Auth::user()->id)
            @if($proposal->punyaNilai())
                <a href="{{ route('lihat.hasil.review',['id' => $proposal->id]) }}" class="btn btn-primary">Lihat hasil
                    review</a>
            @endif
        @endif
    </div>
</div>