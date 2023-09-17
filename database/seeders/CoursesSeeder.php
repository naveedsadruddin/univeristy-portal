<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructor = User::where('email','instructor@instructor.com')->first();
        $course= Course::create([
            'title'=> 'Fundamentals of programing',
            'description' => 'this course is to learn fundamentals of programing',
            'start_date' => Carbon::now()->toDateString(),
            'end_date' => Carbon::now()->addYear()->toDateString(),
            'user_id' => $instructor->id
        ]);

        $student = User::where('email','student@student.com')->first();

        $enrollment = Enrollment::create([
            'course_id' => $course->id,
            'user_id' =>$student->id,
            'date' => Carbon::now()->toDateString()
        ]);
    }
}
