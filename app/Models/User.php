<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_user',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'nim', 'id_user');
    }
    
    public function admin()
    {
        return $this->hasOne(Admin::class, 'id_admin', 'id_user');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'npdn', 'id_user');
    }

    public function isMahasiswa()
    {
        return $this->mahasiswa()->exists();
    }

    public function isAdmin()
    {
        return $this->admin()->exists();
    }

    public function isDosen()
    {
        return $this->dosen()->exists();
    }
}
