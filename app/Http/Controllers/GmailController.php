<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GmailDemo;
use App\Models\Alumni;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;

class GmailController extends Controller
{
//     public function home(){
//         return view('emails.home');
//     }

//     public function showMessage()
// {
//     return view('emails.mymessage');
// }
    public function send(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'body' => 'required',
            'email' => 'nullable|string',
            'sendToAll' => 'nullable|boolean',
            'batch' => 'nullable|string',
        ]);

        $data = [
            'body' => $request->body,
        ];

        $emails = [];

        // Determine which emails to send to
        if ($request->has('sendToAll') && $request->sendToAll) {
            // Send to all alumni
            $emails = Alumni::pluck('email')->toArray();
        } elseif (!empty($request->emails)) {
            // Specific emails provided
            $emails = explode(',', $request->emails);
        } elseif (!empty($request->batch)) {
            // Batch number provided
            $emails = Alumni::whereIn('batch', explode(',', $request->batch))
                            ->pluck('email')->toArray();
        }

        // Remove any duplicate or empty emails
        $emails = array_filter(array_unique(array_map('trim', $emails)));

        foreach ($emails as $email) {
            $alumnus = Alumni::where('email', $email)->first();
            if ($alumnus) {
                Mail::to($alumnus->email)->send(new GmailDemo($data));

                // Update pending status
                $alumnus->update(['pending' => true]);
            }
        }

        // Show success message and redirect
        return Redirect::to('/alumnis')->with('success', 'Emails sent successfully to the selected alumni and pending status updated!');
    }
}
