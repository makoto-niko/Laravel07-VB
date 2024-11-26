<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('user_edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = auth()->user();
        $validated = $request->validated();

        if ($request->hasFile('profile_img')) {
            // 古い画像を削除
            if ($user->profile_img && Storage::exists('public/profile_img/' . $user->profile_img)) {
                Storage::delete('public/profile_img/' . $user->profile_img);
            }

            // 新しい画像を保存
            $filename = time() . '.' . $request->profile_img->extension();
            $request->profile_img->storeAs('public/profile_img', $filename);
            $validated['profile_img'] = $filename;
        }

        $user->update($validated);

        return redirect()->route('tasks.index')->with('success', 'プロフィールを更新しました');
    }
};
