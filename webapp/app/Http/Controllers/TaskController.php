<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        // クエリビルダーの初期化
        $query = Task::with('user');

        // 検索条件の適用
        if ($request->search) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        if ($request->assignee) {
            if ($request->assignee === 'self') {
                $query->where('user_id', auth()->id());
            } else {
                $query->where('user_id', $request->assignee);
            }
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('task_status', $request->status);
        }

        // ソートの適用（デフォルトは作成日時の降順）
        $query->orderBy('created_at', 'desc');

        // ページネーションの適用
        $tasks = $query->paginate(10);

        // ユーザー一覧の取得
        $users = User::all();

        return view('task_index', compact('tasks', 'users'));
    }

    public function create()
    {
        $users = User::all();
        return view('task_create', compact('users'));
    }

    public function store(StoreRequest $request)
    {

        Task::create([
            'title' => $request->name,
            'user_id' => $request->user_id === 'self' ? auth()->id() : $request->user_id,
            'task_status' => (int)$request->status,
            'comment' => $request->note,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを作成しました');
    }


    public function edit(Task $task)
    {

        $users = User::all(); //必要なユーザーのリストを取得
        return view('task_edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {

        // タスクの更新
        $task->update([
            'title' => $request->name,
            'user_id' => $request->user_id === 'self' ? auth()->id() : $request->user_id,
            'task_status' => (int)$request->status,
            'comment' => $request->note,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました');
    }
}
