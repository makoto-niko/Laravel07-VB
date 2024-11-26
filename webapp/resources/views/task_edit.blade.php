@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
        </div>
        <div class="card mx-auto" style="max-width: 600px;"> <!-- カードの最大幅を設定 -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">タスク作成</h5>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST" class="mx-auto"> <!-- フォームを中央揃え -->
                    @csrf

                    <!-- タスク名 -->
                    <div class="form-group mb-3"> <!-- マージンボトムを追加 -->
                        <label for="name">タスク名 <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required>
                    </div>

                    <!-- 担当者 -->
                    <div class="form-group mb-3">
                        <label for="user_id">担当者 <span class="text-danger">*</span></label>
                        <select class="form-control @error('user_id') is-invalid @enderror"
                            id="user_id"
                            name="user_id"
                            required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ステータス -->
                    <div class="form-group mb-3">
                        <label for="status">ステータス</label>
                        <select name="status" class="form-control" id="status">
                            <option value="">全てのステータス</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>未着手</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>着手中</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>保留</option>
                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>完了</option>
                        </select>
                    </div>

                    <!-- 備考 -->
                    <div class="form-group mb-4">
                        <label for="note">備考</label>
                        <textarea class="form-control @error('note') is-invalid @enderror"
                            id="note"
                            name="note"
                            rows="3">{{ old('note') }}</textarea>
                    </div>

                    <!-- 登録ボタン -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection