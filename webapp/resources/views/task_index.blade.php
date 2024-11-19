@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoリスト</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h1>タスク一覧</h1>
    </div>
    <div class="container mt-3">
        <div class="container mb-4">

            {{ csrf_field() }}
            <div class="row">
                {{ Form::text('newTodo', null, ['class' => 'form-control col-8 mr-5']) }}
                {{ Form::date('newDeadline', null, ['class' => 'mr-5']) }}
                {{ Form::submit('新規追加', ['class' => 'btn btn-primary']) }}
            </div>
            {!! Form::close() !!}
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 30%">ID</th>
                    <th scope="col" style="width: 30%">タスク名</th>
                    <th scope="col" style="width: 30%">担当者</th>
                    <th scope="col" style="width: 30%">ステータス</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">number</th>
                    <th scope="row">taskname</th>
                    <th scope="row">name</th>
                    <th scope="row">ステータス</th>
                    <td><a href="" class="btn btn-primary">編集</a></td>
                    <td>{{ Form::submit('削除', ['class' => 'btn btn-danger']) }}</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <td><a href="" class="btn btn-primary">編集</a></td>
                    <td>{{ Form::submit('削除', ['class' => 'btn btn-danger']) }}</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <th scope="row"></th>
                    <td><a href="" class="btn btn-primary">編集</a></td>
                    <td>{{ Form::submit('削除', ['class' => 'btn btn-danger']) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
@endsection