@extends('layouts.main')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>{{ $balance['name'] }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>email</th>
                            <th>amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $balance['email'] }}</td>
                            <td>{{ $balance['amount'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection