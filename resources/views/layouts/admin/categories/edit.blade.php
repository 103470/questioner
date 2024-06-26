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
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Kategória szerkesztése')}}</h1>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm shadow-sm">{{ __('Vissza') }}</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control" id="name" placeholder="name" name="name" value="{{ old('name', $category->name) }}" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">{{ __('Mentés')}}</button>
                </form>
            </div>
        </div>

</div>
@endsection
