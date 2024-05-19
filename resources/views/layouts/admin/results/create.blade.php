@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


        <div class="card shadow">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Végeredmény létrehozása') }}</h1>
                    <a href="{{ route('admin.results.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Vissza') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.results.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question">{{ __('Kérdés') }}</label>
                        <select class="form-control" name="questions[]" multiple id="question">
                            @foreach($questions as $id => $question)
                                <option value="{{ $id }}">{{ $question }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_points">{{ __('Összpontszám') }}</label>
                        <input type="number" class="form-control" id="total_points" placeholder="{{ __('total_points') }}" name="total_points" value="{{ old('total_points') }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Mentés') }}</button>
                </form>
            </div>
        </div>

</div>
@endsection