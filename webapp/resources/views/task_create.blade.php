@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <!-- [1：戻るボタン] -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">タスク作成</h5>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
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

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <!-- タスク名 -->
                        <div class="form-group">
                            <label for="name">タスク名 <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required>
                        </div>

                        <!-- [3：担当者] -->
                        <div class="form-group">
                            <label for="user_id">担当者 <span class="text-danger">*</span></label>
                            <select class="form-control @error('user_id') is-invalid @enderror"
                                id="user_id"
                                name="user_id"
                                required>
                                <option value="self">自分</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ステータス -->
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="">全てのステータス</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>未着手</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>着手中</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>保留</option>
                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>完了</option>
                            </select>
                        </div>

                        <!-- 備考 -->
                        <div class="form-group">
                            <label for="note">備考</label>
                            <textarea class="form-control @error('note') is-invalid @enderror"
                                id="note"
                                name="note"
                                rows="3">{{ old('note') }}</textarea>
                        </div>

                        <!-- [6：登録ボタン] -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection