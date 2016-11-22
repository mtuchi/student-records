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
      $this->call(RolesTableSeeder::class);
      $this->call(UsersTableSeeder::class);
      $this->call(StudentsTableSeeder::class);
      $this->call(SubjectsTableSeeder::class);
      $this->call(GradesTableSeeder::class);
      $this->call(QuartersTableSeeder::class);
      $this->call(ScoresTableSeeder::class);
      $this->call(StudentSubjectTableSeeder::class);
      $this->call(AttendancesTableSeeder::class);
      $this->call(TeachersTableSeeder::class);
      $this->call(GradeStudentTableSeeder::class);
      $this->call(GradeSubjectTableSeeder::class);
      $this->call(GradeQuarterTableSeeder::class);
      $this->call(MonthsTableSeeder::class);
    }
}
