@extends('layouts.app')

@section('content')
    @if(Auth::user()->logbook()->count() > 0)
        @foreach(Auth::user()->logbook()->get() as $logbook)
            {{ $logbook }} <br/>
        @endforeach

        @if(Auth::user()->isKetua())
            <form action="{{ route('tambah.logbook') }}" method="post">

                {{ csrf_field() }}

                {{ method_field('put') }}

                Catatan<br/>
                <textarea name="catatan"></textarea><br/>

                Biaya<br/>
                <input type="number" name="biaya"/><br/>

                <input type="submit" value="Tambah"/>

            </form>
        @endif
    @else
        Anda belum memiliki logbook.<br/>
    @endif
@endsection