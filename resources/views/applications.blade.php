@extends('layouts.app')

@section('content')
    <div class="container large-container">
        <div class="card">
            <div class="card-header">{{ __('Overview') }}</div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">OS</th>
                                <th scope="col">Application name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apps as $app)
                                <tr>
                                    <th scope="row">{{ $app->id }}</th>
                                    <td>Windows</td>
                                    <td>{{ $app->application }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
