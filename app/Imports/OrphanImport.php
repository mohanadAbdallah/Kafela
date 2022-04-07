<?php

namespace App\Imports;

use App\OrphanSponsor;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;

class OrphanImport implements OnEachRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();
        if ($rowIndex == 0 || $rowIndex == 1) {
            return null;
        }
        $orphan_file_no = $row[0];
        $name = $row[1];
        $mother_file_no = $row[2];
        $mother_name = $row[3];
        $mother_phone = $row[4];
        $mother_identity = $row[5];
        $mother_iban = $row[6];
//        dd($mother_iban);
        $mother_salary = $row[7];
        $gender = $row[8];
//        dd($row[9]);
        $orphan_birth_date = $row[9];//\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('d-m-Y');
//        $orphan_birth_date = $row[9];
        $orphan_country = $row[10];
        $orphan_identity = $row[11];
        $orphan_age_range = $row[12];
        $orphan_study_range = $row[13];
        $orphan_school_name = $row[14];
        $orphan_study_year = $row[15];
        $orphan_health_state = $row[16];
        $orphan_disease_name = $row[17];
        $orphan_disease_type = $row[18];
        $sponsor_file_no = $row[19] ?? '';
        $bank_name = $row[20] ?? '';

        if($name == '') $name = '--';
        $email = Str::random(6);
        $password = Hash::make(12345678123);;
        $orphan_old_year = 0;
        if ($orphan_birth_date != '') {
            $dateOfBirth = Carbon::createFromFormat('d-m-Y', $orphan_birth_date)->format('Y-m-d');
            $orphan_birth_date = Carbon::createFromFormat('d-m-Y', $orphan_birth_date)->format('Y-m-d');
            $orphan_old_year = Carbon::parse($dateOfBirth)->age;
        }


        $orphan = User::updateOrCreate(
            ['orphan_file_no' => $orphan_file_no,],
            [
                'orphan_file_no' => $orphan_file_no, 'name' => $name, 'mother_file_no' => $mother_file_no,
                'mother_name' => $mother_name, 'mother_phone' => $mother_phone, 'phone' => $mother_phone, 'mother_identity' => $mother_identity,
                'mother_iban' => $mother_iban, 'mother_salary' => $mother_salary, 'gender' => $gender,
                'orphan_birth_date' => $orphan_birth_date, 'orphan_country' => $orphan_country, 'orphan_identity' => $orphan_identity,
                'orphan_age_range' => $orphan_age_range, 'orphan_study_range' => $orphan_study_range, 'orphan_school_name' => $orphan_school_name,
                'orphan_study_year' => $orphan_study_year, 'orphan_disease_name' => $orphan_disease_name, 'orphan_health_state' => $orphan_health_state,
                'orphan_old_year' => $orphan_old_year, 'orphan_disease_type' => $orphan_disease_type, 'email' => $email,
                'password' => $password, 'bank_name' => $bank_name,
            ]
        );

        if ($sponsor_file_no != '' && $sponsor_file_no != null) {
            $sponsor = User::where('sponsor_file_no', $sponsor_file_no)->first();
            if ($sponsor) {
                $orphan_sponsor = new  OrphanSponsor();
                $orphan_sponsor->orphan_id = $orphan->id;
                $orphan_sponsor->sponsor_id = $sponsor->id;
                $orphan_sponsor->save();
            }
        }

        return response(collect($orphan));

    }
}
