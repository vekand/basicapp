<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_visitor = new Role();
        $role_visitor->name = 'Visitor';
        $role_visitor->description = 'A normal User';
        $role_visitor->save();

        $role_blogger = new Role();
        $role_blogger->name = 'Blogger';
        $role_blogger->description = 'A Blogger';
        $role_blogger->save();
        
        $role_referee = new Role();
        $role_referee->name = 'Referee';
        $role_referee->description = 'A Referee';
        $role_referee->save();

        $role_teacher = new Role();
        $role_teacher->name = 'Teacher';
        $role_teacher->description = 'A Teacher';
        $role_teacher->save();

        $role_student = new Role();
        $role_student->name = 'Student';
        $role_student->description = 'A Student';
        $role_student->save();

        $role_author = new Role();
        $role_author->name = 'Author';
        $role_author->description = 'An Author';
        $role_author->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'A Admin';
        $role_admin->save();

        $role_super = new Role();
        $role_super->name = 'Super';
        $role_super->description = 'A Superuser';
        $role_super->save();
    }
}
