@extends('layouts.app')

@section('content')
    <h3>Proposal</h3>
    <ul>
        @foreach($proposal as $item)
            @if($item->judul != '' && $item->judul != null)
            <li>
                {{ $item->judul }}
                <a href="{{ route('edit.reviewer',['idproposal' => $item->id]) }}" class="btn btn-primary">Atur Reviewer</a>
            </li>
            @endif
        @endforeach
    </ul>
@endsection