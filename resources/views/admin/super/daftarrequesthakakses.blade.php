@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Hak Akses</h4>
            <p class="category">Daftar permintaan hak akses oleh pengguna</p>
        </div>
        <div class="card-content table-responsive">
            <table class="table">
                <thead class="text-primary">
                <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Hak akses</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pengguna as $person)
                    <tr>
                        <td>{{ $person->id_pengguna }}</td>
                        <td>{{ $person->nama }}</td>
                        <td>{{ $person->hakakses }}</td>
                        <td>
                            <form action="{{ route('set.terimahakakses') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id_pengguna" value="{{ $person->id_pengguna }}">
                                <input type="hidden" name="id_hak_akses" value="{{ $person->id_hak_akses }}">
                                <input type="submit" name="submit" value="terima">
                            </form>
                            <form action="{{ route('set.tolakhakakses') }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                <input type="hidden" name="id_pengguna" value="{{ $person->id_pengguna }}">
                                <input type="hidden" name="id_hak_akses" value="{{ $person->id_hak_akses }}">
                                <input type="submit" name="submit" value="tolak">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection