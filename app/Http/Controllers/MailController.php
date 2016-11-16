<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MailController extends Controller
{
     public function sendEmailReminder(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $profid = $user->prof_id;
        $prof = Prof::find($profid);
        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->from('andrei_veklinec@yahoo.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Your Reminder!');
        });
    }
}
}
