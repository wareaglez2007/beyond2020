@extends('layouts.app')

@section('content')
    <div class="container large-container">
        <div class="card">
            <div class="card-header">{{ __('Groups') }}</div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Group Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <th scope="row">{{ $group->id }}</th>
                                    <td>{{ $group->group }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
