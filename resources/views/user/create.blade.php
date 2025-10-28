@extends('layouts.main')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Добавление пользователя</h2>
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                <label for="inputTitle" class="form-label">Имя</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </td>
                            <td>
                                <label for="inputTitle" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            </td>
                            <td>
                                <label for="inputTitle" class="form-label">Пароль</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary  mt-3">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection