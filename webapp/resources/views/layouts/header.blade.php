<div class="max-w-7xl bg-sky-200 py-6 px-4 sm:px-6 lg:px-8">
    <nav class="space-x-4">
        <a href="{{ route('tasks.index') }}" class="text-gray-700">タスク一覧</a>
        <a href="{{ route('tasks.create') }}" class="text-gray-700">タスク新規登録</a>
        <a href="{{ route('profile.edit') }}" class="text-gray-700">ユーザー情報変更</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-gray-700">ログアウト</button>
        </form>
    </nav>
</div>