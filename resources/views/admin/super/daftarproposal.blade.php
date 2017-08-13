@extends('layouts.app')

@section('content')
    <h3>Proposal</h3>
    <ul>
        @foreach($proposal as $item)
            <li>
                {{ $item->judul }}
                <form action="{{ route('editreviewer') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <input type="hidden" name="judul" value="{{ $item->judul }}">
                    <input type="hidden" name="id_proposal" value="{{ $item->id }}">
                    <input type="submit" name="submit" value="set reviewer">
                </form>
            </li>
        @endforeach
    </ul>
@endsection