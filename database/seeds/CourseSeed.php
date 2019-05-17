<?php

use Illuminate\Database\Seeder;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class, 5)->create();

        foreach (Course::all() as $course) {
            $course->teachers()-sync([1]);
        }
    }
}