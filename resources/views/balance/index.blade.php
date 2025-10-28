@extends('layouts.main')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Выберите операцию:</h1>
                <table>
                    <tr>
                        <td>
                            <a href="{{ route('user.create') }}" class="btn btn-info">Добавить пользователя</a>
                        </td>
                        <td>
                            <a href="{{ route('deposit.create') }}" class="btn btn-info">Начисление средств</a>
                        </td>
                        <td>
                            <a href="{{ route('withdraw.create') }}" class="btn btn-info">Списание средств</a>
                        </td>
                        <td>
                            <a href="{{ route('transfer.create') }}" class="btn btn-info">Перевод между пользователями</a>
                        </td>
                        <td>
                            <a href="{{ route('balance.users') }}" class="btn btn-info">Получение баланса пользователей</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection