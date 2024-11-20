<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:0,1,2,3',
            'note' => 'nullable|max:1000',
        ], [
            'name.required' => 'タスク名は必須です',
            'user_id.required' => '担当者は必須です',
            'status.required' => 'ステータスは必須です',
        ]);

        // タスクの作成
        Task::create([
            'title' => $request->name,
            'user_id' => $request->user_id === 'self' ? auth()->id() : $request->user_id,
            'task_status' => (int)$request->status, // 数値として保存
            'comment' => $request->note,
        ]);

        return redirect()->route('tasks.index')->with('success', 'タスクを作成しました');
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
