@extends('layouts.app')

@section('content')
<div class="container mt-3 text-center">
    <!-- ユーザー情報 -->
    <div class="mb-4">
        <img src="{{ Auth::user()->avatar_url ?? 'default.png' }}" class="rounded-circle" style="width: 40px;">
        <span>{{ Auth::user()->name }}</span>
    </div>

    <!-- 検索フォーム -->
    <form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
        <div class="d-flex gap-3 align-items-center">
            <!-- フリーワード検索 -->
            <input type="text" name="search" class="form-control" style="width: 200px;" placeholder="検索">

            <!-- 担当者選択 -->
            <select name="assignee" class="form-control" style="width: 200px;">
                <option value="">担当者（全員）</option>
                <option value="self">自分</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <!-- ステータス選択 -->
            <select name="status" class="form-control" style="width: 200px;">
                <option value="">全てのステータス</option>
                <option value="0">未着手</option>
                <option value="1">着手中</option>
                <option value="2">保留</option>
                <option value="3">完了</option>
            </select>

            <!-- 検索ボタン -->
            <button type="submit" class="btn btn-primary" style="width: 100px;">検索</button>
        </div>
    </form>

    <!-- タスク一覧 -->
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>タスク名</th>
                        <th>担当者</th>
                        <th>ステータス</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->user->name }}</td>
                        <td>
                            @switch($task->task_status)
                            @case(0) 未着手 @break
                            @case(1) 着手中 @break
                            @case(2) 保留 @break
                            @case(3) 完了 @break
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">編集</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('削除してよろしいですか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $tasks->links() }}
</div>
@endsection