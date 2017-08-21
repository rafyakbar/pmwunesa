<div class="row">
    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-4">
                <b>Judul Proposal</b>
            </div>
            <div class="col-lg-8">
                <span>{{ $proposal->judul }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <b>Jenis Usaha</b>
            </div>
            <div class="col-lg-8">
                <span>{{ $proposal->jenis_usaha }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <b>Usulan Dana</b>
            </div>
            <div class="col-lg-8">
                <span>{{ Dana::format($proposal->usulan_dana) }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <b>Pengusul</b>
            </div>
            <div class="col-lg-8">
                <ol style="padding-left:15px">
                    @foreach($proposal->mahasiswa()->get() as $pengusul)
                        <li>{{ $pengusul->pengguna()->nama }} {!! $pengusul->pengguna()->isKetua() ? '<b>(Ketua)</b>' : '' !!}</li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <b>Keyword</b>
            </div>
            <div class="col-lg-8">
                <span>{{ str_replace('|',', ',$proposal->keyword) }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <b>Informasi Review</b>
            </div>
            <div class="col-lg-8">
                @if($proposal->lolos())
                    <span>Proposal ini telah lolos</span>
                @elseif($proposal->lolos(1))
                    <span>Proposal ini telah lolos tahap 1</span>
                @else
                    <span>Proposal ini belum lolos</span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row">
            <div class="col-lg-2">
                <b>Abstrak</b>
            </div>
            <div class="col-lg-10">
                <span>{!! $proposal->abstrak !!}</span>
            </div>
        </div>
    </div>
</div>