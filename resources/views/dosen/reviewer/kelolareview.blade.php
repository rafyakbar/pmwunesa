@extends('layouts.app')

@section('content')

    <div class="card">

        <div class="card-header" data-background-color="red">

            <h4>{{ $type == 'edit' ? 'Edit' : 'Beri' }} Nilai pada proposal <strong>{{ $proposal->judul }}</strong></h4>
            <span>Tahap {{ $proposal->pivot->tahap }}</span>

        </div>

        <div class="card-content">

            <div class="row">

                <div class="col-lg-6">

                    <form action="{{ $type == 'edit' ? route('edit.nilai.review',['id'=>$proposal->pivot->id]) : route('tambah.nilai.review',['id'=>$proposal->pivot->id]) }}" method="post">

                        {{ csrf_field() }}

                        {{ $type == 'edit' ? method_field('patch') : method_field('put') }}

                        <table class="table">
                            <thead class="text-danger">
                            <tr>
                                <th>Aspek</th>
                                <th>Nilai</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($daftaraspek as $index => $aspek)
                                <tr>
                                    <td>{{ $aspek->nama }}</td>
                                    <td>
                                        @for($i = 1;$i <= 5;$i++)
                                            {{ $i }}<input type="radio" name="nilai[{{ $aspek->id }}]" value="{{ $i }}" {{ $type == 'edit' && $penilaian->get()[$index]->pivot->nilai == $i ? 'checked' : '' }}/>&nbsp;
                                        @endfor
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <textarea placeholder="Komentar" class="form-control" name="komentar">{{ $type == 'edit' ? $proposal->pivot->komentar : '' }}</textarea>

                        <input class="btn btn-danger" type="submit" value="Kirim"/>

                    </form>


                </div>

            </div>

        </div>

    </div>

@endsection
