@extends('layouts.app')

@section('content')
    <ul>
        @foreach($fakultas as $item)
            <li>
                {{ $item->nama }}
            </li>
        @endforeach
    </ul>
    <form action="{{ route('tambah.fakultas') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('put') }}
        <textarea name="fakultas"></textarea>
        <input type="submit">
    </form>
@endsection