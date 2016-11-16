<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Location;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_visitor = Role::where('name', 'Visitor')->first();
        $role_blogger = Role::where('name', 'Blogger')->first();
        $role_referee = Role::where('name', 'Referee')->first();
        $role_teacher = Role::where('name', 'Teacher')->first();
        $role_student = Role::where('name', 'Student')->first();
        $role_author  = Role::where('name', 'Author')->first();
        $role_admin   = Role::where('name', 'Admin')->first();
        $role_super   = Role::where('name', 'Super')->first();

        /*$visitor = new User();
        $visitor->first_name = 'Victor';
        $visitor->last_name = 'Visitor';
        $visitor->email = 'visitor@example.com';
        $visitor->password = bcrypt('visitor');
        $visitor->prl = 'visitor';
        $visitor->prof_id = 3;
        $visitor->adresa = 'local';
        $visitor->oras = 'local';
        $visitor->scoala = 'local';
        $visitor->activ = 1;
        $visitor->save();
        $visitor->roles()->attach($role_visitor);

        $blogger = new User();
        $blogger->first_name = 'Ivan';
        $blogger->last_name = 'Blogger';
        $blogger->email = 'blogger@example.com';
        $blogger->password = bcrypt('blogger');
        $blogger->prl = 'blogger';
        $blogger->prof_id = 3;
        $blogger->adresa = 'local';
        $blogger->oras = 'local';
        $blogger->scoala = 'local';
        $blogger->activ = 1;
        $blogger->save();
        $blogger->roles()->attach($role_blogger);

        $referee = new User();
        $referee->first_name = 'Nicu';
        $referee->last_name = 'Referee';
        $referee->email = 'referee@example.com';
        $referee->password = bcrypt('referee');
        $referee->prl = 'referee';
        $referee->prof_id = 3;
        $referee->adresa = 'local';
        $referee->oras = 'local';
        $referee->scoala = 'local';
        $referee->activ = 1;
        $referee->save();
        $referee->roles()->attach($role_referee);

        $teacher = new User();
        $teacher->first_name = 'Nelu';
        $teacher->last_name = 'Teacher';
        $teacher->email = 'teacher@example.com';
        $teacher->password = bcrypt('teacher');
        $teacher->prl = 'teacher';
        $teacher->prof_id = 3;
        $teacher->adresa = 'local';
        $teacher->oras = 'local';
        $teacher->scoala = 'local';
        $teacher->activ = 1;
        $teacher->save();
        $teacher->roles()->attach($role_teacher);

        $student = new User();
        $student->first_name = 'Andy';
        $student->last_name = 'Student';
        $student->email = 'student@example.com';
        $student->password = bcrypt('student');
        $student->prl = 'student';
        $student->prof_id = 3;
        $student->adresa = 'local';
        $student->oras = 'local';
        $student->scoala = 'local';
        $student->activ = 1;
        $student->save();
        $student->roles()->attach($role_student);

        $author = new User();
        $author->first_name = 'Lori';
        $author->last_name = 'Author';
        $author->email = 'author@example.com';
        $author->password = bcrypt('author');
        $author->prl = 'author';
        $author->prof_id = 3;
        $author->adresa = 'local';
        $author->oras = 'local';
        $author->scoala = 'local';
        $author->activ = 1;
        $author->save();
        $author->roles()->attach($role_author);*/

        $super = new User();
        $super->first_name = 'Andrei';
        $super->last_name = 'Andrei';
        $super->email = 'andrei@example.com';
        $super->password = bcrypt('superuser');
        $super->prl = 'superuser';
        $super->prof_id = 1;
        $super->adresa = 'local';
        $super->oras = 'local';
        $super->scoala = 'local';
        $super->activ = 1;
        $super->save();
        $super->roles()->attach($role_author);
        $super->roles()->attach($role_admin);
        $super->roles()->attach($role_super);

        /*$admin = new User();
        $admin->first_name = 'Catalin George';
        $admin->last_name = 'Ardelean';
        $admin->email = 'cata@example.com';
        $admin->password = bcrypt('admin');
        $admin->prl = 'admin';
        $admin->prof_id = 2;
        $admin->adresa = 'local';
        $admin->oras = 'local';
        $admin->scoala = 'local';
        $admin->activ = 1;
        $admin->save();
        $admin->roles()->attach($role_author);
        $admin->roles()->attach($role_admin);*/

        $admin = new User();
        $admin->first_name = 'Petre';
        $admin->last_name = 'Nad Titus';
        $admin->email = 'petrenadtitus@example.com';
        $admin->password = bcrypt('admin');
        $admin->prl = 'admin';
        $admin->prof_id = 2;
        $admin->adresa = 'local';
        $admin->oras = 'local';
        $admin->scoala = 'local';
        $admin->activ = 1;
        $admin->save();
        $admin->roles()->attach($role_author);
        $admin->roles()->attach($role_admin);

        /*$admin = new User();
        $admin->first_name = 'Zoltan';
        $admin->last_name = 'Pall';
        $admin->email = 'zoli@example.com';
        $admin->password = bcrypt('admin');
        $admin->prl = 'admin';
        $admin->prof_id = 3;
        $admin->adresa = 'local';
        $admin->oras = 'local';
        $admin->scoala = 'local';
        $admin->activ = 1;
        $admin->save();
        $admin->roles()->attach($role_author);
        $admin->roles()->attach($role_admin);*/

        $admin = new User();
        $admin->first_name = 'Ludovic';
        $admin->last_name = 'Lazar';
        $admin->email = 'ludovic@example.com';
        $admin->password = bcrypt('admin');
        $admin->prl = 'admin';
        $admin->prof_id = 3;
        $admin->adresa = 'local';
        $admin->oras = 'local';
        $admin->scoala = 'local';
        $admin->activ = 1;
        $admin->save();
        $admin->roles()->attach($role_author);
        $admin->roles()->attach($role_admin);

        $student = new User();
        $student->first_name = 'Elev';
        $student->last_name = 'Eminent';
        $student->email = 'elev@example.com';
        $student->password = bcrypt('111111');
        $student->prl = '111111';
        $student->prof_id = 3;
        $student->adresa = 'local';
        $student->oras = 'local';
        $student->scoala = 'local';
        $student->activ = 1;
        $student->save();
        $student->roles()->attach($role_student);

        $student = new User();
        $student->first_name = 'Pista';
        $student->last_name = 'Pista';
        $student->email = 'pista@example.com';
        $student->password = bcrypt('111111');
        $student->prl = '111111';
        $student->prof_id = 3;
        $student->adresa = 'local';
        $student->oras = 'local';
        $student->scoala = 'local';
        $student->activ = 1;
        $student->save();
        $student->roles()->attach($role_student);

        $student = new User();
        $student->first_name = 'Ionel';
        $student->last_name = 'Ionel';
        $student->email = 'ionel@example.com';
        $student->password = bcrypt('111111');
        $student->prl = '111111';
        $student->prof_id = 2;
        $student->adresa = 'local';
        $student->oras = 'local';
        $student->scoala = 'local';
        $student->activ = 1;
        $student->save();
        $student->roles()->attach($role_student);

        
    }
}
