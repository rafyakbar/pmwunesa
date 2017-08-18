<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="title">Undangan Bimbingan</h4>
                <p class="category">Anda diminta untuk membimbing mahasiswa berikut</p>
            </div>

            <div class="card-content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Informasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($undangan->cursor() as $proposal)
                            <tr>
                                <td>
                                    {{ $proposal->ketua()->nama }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('terima.undangan.dosen') }}" data-proposal="{{ $proposal->id }}" class="btn btn-success terima-undangan">Terima</a>
                                        <a href="{{ route('tolak.undangan.dosen') }}" data-proposal="{{ $proposal->id }}" class="btn btn-danger tolak-undangan">Tolak</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="title">Tim Bimbingan Anda</h4>
                <p class="category">Berikut adalah tim yang berada dibawah bimbingan anda</p>
            </div>

            <div class="card-content">
                @if($bimbingan->count() > 0)
                    Anda telah menjadi pembimbing dari mahasiswa berikut :
                    <ul>
                        @foreach($bimbingan->cursor() as $proposal)
                            <li>{{ $proposal->ketua()->nama }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
