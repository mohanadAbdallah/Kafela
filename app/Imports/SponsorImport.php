<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Row;

class SponsorImport implements OnEachRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        if($rowIndex == 0 || $rowIndex == 1){
            return null;
        }
        $sponsor_file_no = $row[0];
        $name = $row[1];
        $phone = $row[2];
        $ensure_type = $row[3];
        $sponsor_pay_start =\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d') ;
        $sponsor_pay_value = $row[5];

        $sponsor_pay_end = Carbon::today();

        if ($sponsor_pay_start != '') {
            $sponsor_pay_start = Carbon::createFromFormat('Y-m-d', $sponsor_pay_start)->format('Y-m-d');


        }else{
            $sponsor_pay_start = Carbon::today();
        }
        $sponsor_pay_end = $this->getPayEndDate($ensure_type, $sponsor_pay_start);

        $email = Str::random(6);
        $password = Hash::make($phone);

        $sponsor = User::updateOrCreate(
            ['sponsor_file_no'=>$sponsor_file_no,],
            [
                'sponsor_file_no'=>$sponsor_file_no,'name'=>$name,'phone'=>$phone,
                'ensure_type'=>$ensure_type,'ensure_type_text'=>$ensure_type,'email'=>$email,
                'password'=>$password,'role'=>'sponsor','sponsor_pay_start'=>$sponsor_pay_start,
                'sponsor_pay_end'=>$sponsor_pay_end,'sponsor_pay_value'=>$sponsor_pay_value,
            ]
        );


        return response(collect($sponsor));

    }

    protected function getPayEndDate($ensure_type, $startDate)
    {
        if ($ensure_type == 1) {
            return Carbon::parse($startDate)->addMonths(1);
        } else if ($ensure_type == 2) {
            return Carbon::parse($startDate)->addYears(1);
        }else if ($ensure_type == 15) {
            return Carbon::parse($startDate)->addYears(2);
        }else if ($ensure_type == 16) {
            return Carbon::parse($startDate)->addYears(3);
        } else if ($ensure_type == 3) {
            return Carbon::parse($startDate)->addMonths(1);
        } else if ($ensure_type == 4) {
            return Carbon::parse($startDate)->addMonths(2);
        } else if ($ensure_type == 5) {
            return Carbon::parse($startDate)->addMonths(3);
        } else if ($ensure_type == 6) {
            return Carbon::parse($startDate)->addMonths(4);
        } else if ($ensure_type == 7) {
            return Carbon::parse($startDate)->addMonths(5);
        } else if ($ensure_type == 8) {
            return Carbon::parse($startDate)->addMonths(6);
        } else if ($ensure_type == 9) {
            return Carbon::parse($startDate)->addMonths(7);
        } else if ($ensure_type == 10) {
            return Carbon::parse($startDate)->addMonths(8);
        } else if ($ensure_type == 11) {
            return Carbon::parse($startDate)->addMonths(9);
        } else if ($ensure_type == 12) {
            return Carbon::parse($startDate)->addMonths(10);
        } else if ($ensure_type == 13) {
            return Carbon::parse($startDate)->addMonths(11);
        } else if ($ensure_type == 14) {
            return Carbon::parse($startDate)->addMonths(12);
        } else {
            return null;
        }
    }
}
