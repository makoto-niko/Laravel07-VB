@extends('layouts.app')

@section('content')
<div class="container mt-6">
    <h1>新規タスク作成</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-md-3"> <!-- 4等分の1のスペース -->
                    <div class="form-group">
                        <label for="title1">タスク名</label>
                        <input type="text" class="form-control" name="title1" id="title1" value="{{ old('title1') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title2">担当者</label>
                        <input type="text" class="form-control" name="title2" id="title2" value="{{ old('title2') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status">ステータス</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>未着手</option>
                            <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>着手中</option>
                            <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>保留</option>
                            <option value="4" {{ old('status') == 4 ? 'selected' : '' }}>完了</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="title4">備考</label>
                        <input type="textarea" class="form-control" name="title4" id="title4" value="{{ old('title4') }}">
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection