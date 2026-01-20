<?php

namespace App\Imports;

use App\Models\User;
use App\Models\StudentDetail;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // skip baris user
        if ($row[0] === 'name' || empty($row[0])) {
            return null;
        }

        // Buat user
        $user = User::create([
            'role_id' => 3,
            'name' => $row[0],
            'email' => $row[1],
            'password' => Hash::make($row[2]),
            'phone_number' => $row[3] ?? null,
        ]);

        // Buat student detail
        StudentDetail::create([
            'user_id'     => $user->id,
            'nis'         => $row[4] ?? null,
            'nisn'        => $row[5] ?? null,
            'gender'      => $row[6] ?? null,
            'birth_place' => $row[7] ?? null,
            'birth_date'  => $row[8] ?? null,
            'address'     => $row[9] ?? null,
            // 'photo'    => null, // Foto ga diimpor dari file Excel yaa
        ]);

        return $user;
    }
}
