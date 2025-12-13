<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Settings;
use Twilio\Rest\Client;

class SendSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $phone;
    public $message;
    public $settings;

    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
        $this->settings = Settings::find(1);
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        try {
            $client = new Client($this->settings->twilio_account_sid, $this->settings->twilio_auth_token);
            $client->messages->create(
                $this->phone,
                [
                    'from' => $this->settings->twilio_number, // From a valid Twilio number
                    'body' => $this->message
                ]
            );
        } catch (\Twilio\Exceptions\ConfigurationException $e) {
            return back()->with('alert', $e->getMessage());
        }
    }
}
