@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール編集</div>

                <div class="card-body">
                    <!-- 戻るボタン -->
                    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
                        戻る
                    </a>
                    <form method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- プロフィール画像 -->
                        <div class="text-center mb-3">
                            <img src="{{ $user->profile_img  
                                    ? asset('storage/profile_img/' . $user->profile_img)  
                                    : asset('images/default-profile.png') }}"
                                class="rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>

                        <!-- 画像アップロード -->
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">プロフィール画像</label>
                            <input type="file" class="form-control" id="profile_img" name="profile_img">
                            @error('profile_img')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ユーザー名 -->
                        <div class="mb-3">
                            <label for="name" class="form-label">ユーザー名 *</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- メールアドレス -->
                        <div class="mb-3">
                            <label for="email" class="form-label">メールアドレス *</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 登録ボタン -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">更新する</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection