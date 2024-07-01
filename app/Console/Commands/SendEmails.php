<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SendEmails extends Command
{
    protected $signature = 'emails:send';

    protected $description = 'Send emails to recipients from Supabase';

    public function handle()
    {
        $response = Http::get('postgres://postgres.kyvnmxauyshpmlbonamo:ambotsimo06@aws-0-ap-southeast-1.pooler.supabase.com:6543/postgres/rest/v1/email_recipients')
            ->throw()
            ->json();

        foreach ($response['data'] as $recipient) {
            Mail::to($recipient['email'])->send(new(''));
            sleep(2 * 60); // Sleep for 2 minutes before sending next email
        }

        $this->info('Emails sent successfully.');
    }
}
