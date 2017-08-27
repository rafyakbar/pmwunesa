@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi tim</h4>
                </div>

                <div class="card-content">
                    @if(Auth::user()->mahasiswa()->punyaTim())
                        <p>Anggota tim anda : </p>
                        <ul>
                            @foreach(\PMW\Models\Mahasiswa::where('id_proposal',Auth::user()->mahasiswa()->id_proposal)->cursor() as $anggota)
                                <li>{{ $anggota->pengguna()->nama }} @if($anggota->pengguna()->isKetua())
                                        <b>(Ketua)</b> @endif</li>
                            @endforeach
                        </ul>

                    @else
                        <p class="alert alert-warning">
                            Anda belum memiliki tim
                        </p>
                    @endif
                </div>
            </div>
        </div>

        @if($undangan->count() > 0)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Undangan tim</h4>
                    </div>

                    <div class="card-content">
                        Anda mendapat undangan dari <br/>
                        <ul>
                            @foreach($undangan->cursor() as $item)
                                <li>
                                    {{ $item->pengguna()->nama }}
                                    <form action="{{ route('terima.undangan.tim') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="dari" value="{{ $item->id_pengguna }}"/>
                                        <button>Terima Undangan</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection