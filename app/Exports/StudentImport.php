<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class StudentImport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(value: []);
    }

    public function headings(): array
    {
        return ['first_name', 'middle_name', 'last_name', 'email', 'phone', 'gender', 'course_code', 'year_of_study', 'course_level', 'reg_number', 'kin_name', 'kin_phone', 'kin_email', 'kin_relationship', 'sponsored'];
    }

}
