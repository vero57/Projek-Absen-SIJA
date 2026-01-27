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

    // Helper buat konversi format Excel ke tanggal Y-m-d
    private function excelDateToDate($value)
    {
        // kalo udah jadi string tanggal, langsung direturn
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
            // Format dd/mm/yyyy
            $parts = explode('/', $value);
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        }
        // Jika numeric
        if (is_numeric($value)) {
            $unix = ($value - 25569) * 86400;
            return gmdate('Y-m-d', $unix);
        }
        return null;
    }

    public function model(array $row)
    {
        // skip baris user
        if ($row[0] === 'name' || empty($row[0])) {
            return null;
        }

        $birthDate = $this->excelDateToDate($row[8] ?? null);

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
            'birth_date'  => $birthDate,
            'address'     => $row[9] ?? null,
            // 'photo'    => null, // Foto ga diimpor dari file Excel yaa
        ]);

        return $user;
    }
}
