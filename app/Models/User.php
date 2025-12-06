<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'gender',
        'date_of_birth',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* =======================
     * RELATIONSHIPS
     * =======================
     */

    // 🔹 User hanya punya satu role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // 🔹 User bisa jadi anak dari parent (jika banyak parent, tetap belongsToMany)
    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'parent_user');
    }

    // 🔹 User sebagai siswa, masuk ke banyak kelas
    public function classes()
    {
        return $this->belongsToMany(
            ClassModel::class,
            'class_student',
            'student_id', // foreign key di tabel pivot yang mengacu ke users
            'class_id'    // foreign key di tabel pivot yang mengacu ke classes
        );
    }

    // 🔹 User punya banyak kehadiran
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // 🔹 User bisa punya banyak jurnal (misalnya guru yang menulis jurnal)
    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    // 🔹 User bisa punya banyak pelanggaran
    public function violationPoints()
    {
        return $this->hasMany(ViolationPoint::class);
    }

    // 🔹 User punya banyak pesan
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // 🔹 User bisa menerima banyak notifikasi WA
    public function waNotifications()
    {
        return $this->hasMany(WaNotification::class);
    }
}
