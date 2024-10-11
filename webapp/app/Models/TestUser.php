<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestUser extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'remember_token', 'profile_img'];

    public function tasks()
    {
        return $this->hasMany(TestTask::class, 'user_id');
    }
    public function storeUser($request)
    {
        self::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => $request->input('email_verified_at'),
            'password' => $request->input('password'),
            'remember_token' => $request->input('remember_token'),
            'profile_img' => $request->input('profile_img')
        ]);
    }

    public function updateUser($request, $id)
    {
        $users = self::find($id);
        $users->name = $request->input('name');
        $users->email_verified_at = $request->input('email_verified_at');
        $users->password = $request->input('password');
        $users->remember_token = $request->input('remember_token');
        $users->profile_img = $request->input('profile_img');
        $users->save();
    }
    public function deleteUser($id)
    {
        $user = self::find($id);
        $user->delete();
    }
}
