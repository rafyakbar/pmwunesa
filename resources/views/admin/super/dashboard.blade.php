@extends('layouts.app')

@section('brand')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">content_copy</i>
                </div>
                <div class="card-content">
                    <p class="category">Kapasitas database</p>
                    <h3 class="title"> <small>KB</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <a>Kapasitas dari database </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection