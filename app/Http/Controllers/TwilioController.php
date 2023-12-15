<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    public function sendMessage(Request $request)
    {
        $to = $request->input('to');
        $message = $request->input('message');

        $twilio_sid = config('services.twilio.sid');
        $twilio_token = config('services.twilio.token');
        $twilio_phone_number = config('services.twilio.phone_number');


        $client = new Client($twilio_sid, $twilio_token);

        try {
            $client->messages->create(
                $to,
                [
                    'from' => $twilio_phone_number,
                    'body' => $message,
                ]
            );

            return response()->json(['message' => 'Message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
