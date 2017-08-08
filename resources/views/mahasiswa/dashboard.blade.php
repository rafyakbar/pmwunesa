@extends('layouts.app')

@section('content')

@if(Auth::user()->isMahasiswa() && Auth::user()->mahasiswa()->punyaTim())
    <p>Anggota tim anda : </p>
    <ul>
    @foreach(\PMW\Models\Mahasiswa::where('id_proposal',Auth::user()->mahasiswa()->id_proposal)->cursor() as $anggota)
        <li>{{ $anggota->pengguna()->nama }} @if($anggota->pengguna()->isKetua()) <b>(Ketua)</b> @endif</li>
    @endforeach
    </ul>
@endif

@if($undangan->count() > 0)
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
@endif
@endsection