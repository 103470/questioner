@extends('layouts.admin')

@section('content')
<div class="container-fluid">

        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                Összpontszám: {{ $result->total_points }} pont
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('admin.results.index') }}" class="btn btn-primary">
                        <span class="text">{{ __('Vissza') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                            <tr>
                                <th>Kérdés</th>
                                <th>Pontok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result->questions as $question)
                                <tr>
                                    <td>{{ $question->question_text }}</td>
                                    <td>{{ $question->pivot->points }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
@endsection