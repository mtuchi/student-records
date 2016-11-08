<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(GradesTableSeeder::class);
        $this->call(QuartersTableSeeder::class);
        $this->call(ScoreTableSeeder::class);
        $this->call(StudentSubjectSeeder::class);
        $this->call(AttendanceTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(GradeStudentTableSeeder::class);
        $this->call(GradeSubjectTableSeeder::class);
        $this->call(GradeQuarterTableSeeder::class);
    }
}
