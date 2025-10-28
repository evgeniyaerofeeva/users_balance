@extends('layouts.main')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Пользователи:</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Имя пользователя</th>
                            <th>e-mail</th>
                            <th>Получение баланса пользователя</th>
                            <th>Получение баланса пользователя api</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('balance.show', $user->id)}}" class="btn btn-info">
                                        Получение баланса пользователя
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('balance', $user->id)}}" class="btn btn-info">
                                        Получение баланса пользователя
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection