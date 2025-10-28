@extends('layouts.main')

@section('content')

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Начисление средств пользователю</h2>
                <form action="{{ route('deposit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <table>
                        <tr>
                            <td>
                                <label for="inputTitle" class="form-label">Кому</label>
                                <select name="user_id" class="form-control select2">
                                    <option selected="selected" disabled>Выберите кому</option>
                                    @foreach ($users as $user)
                                        <option
                                            value="{{ $user->id }}"
                                        >
                                            {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label for="inputTitle" class="form-label">Сумма</label>
                                <input type="text" class="form-control" id="count" name="amount" value="{{ old('amount') }}">
                            </td>
                            <td>
                                <label for="inputTitle" class="form-label">Комментарий</label>
                                <input type="text" class="form-control" id="comment" name="comment" value="{{ old('comment') }}">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection