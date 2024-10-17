<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'profile_img'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id');
    }

    public static function storeUser($request)
    {
        return self::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => $request->input('email_verified_at'),
            'password' => bcrypt($request->input('password')),
            'remember_token' => $request->input('remember_token'),
            'profile_img' => $request->input('profile_img')
        ]);
    }

    public static function updateUser($request, $id)
    {
        $user = self::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        return $user;
    }

    public static function deleteUser($id)
    {
        $user = self::findOrFail($id);
        return $user->delete();
    }
}
