@extends('layouts.app')

@section('content')
    <h3>Proposal</h3>
    <ul>
        @foreach($proposal as $item)
            @if($item->judul != '' && $item->judul != null)
                <li>
                    {{ $item->judul }} <br>
                    <ul>
                        <p>Tim</p>
                        @foreach(\PMW\Models\Proposal::find($item->id)->mahasiswa()->cursor() as $value)
                            <li>
                                {{ \PMW\User::find($value->id_pengguna)->nama }}
                                @if(\PMW\User::find($value->id_pengguna)->hasRole('Ketua Tim'))
                                    <strong>(Ketua)</strong>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('edit.reviewer',['idproposal' => $item->id]) }}" class="btn btn-primary">Atur Reviewer</a>
                </li>
            @endif
        @endforeach
    </ul>
@endsection