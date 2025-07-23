<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentDataImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row[0] !== 'first_name') {
            $user = User::where('email', $row[3])->orWhere('phone', $row[4])->first();
            $course = Course::where('code', $row[6])->first();
            if ($user == null) {
                $user = User::create([
                    "college_id" => auth()->user()->college_id,
                    'first_name' => $row[0],
                    'middle_name' => $row[1],
                    'last_name' => $row[2],
                    'email' => $row[3],
                    'phone' => $row[4],
                    'gender' => $row[5],
                    'role' => 'student',
                    'password' => Hash::make('Dalma@2025'),
                ]);
                Student::create([
                    'user_id' => $user->id,
                    'course_id' => @$course->id,
                    'college_id' => auth()->user()->college_id,
                    'reg_number' => $row[9],
                    'year_of_study' => $row[7],
                    'course_level' => $row[8],
                    'kin_name' => $row[10],
                    'kin_phone' => $row[11],
                    'kin_email' => $row[12],
                    'kin_relationship' => $row[13],
                    'sponsored' => $row[14],
                ]);
            }
        }
        return null;
    }
}
