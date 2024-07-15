<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use Auth;

class FirebaseController extends Controller
{
    public function config()
    {
        return response()->json([
            'apiKey' => config('services.firebase.api_key'),
            'authDomain' => config('services.firebase.auth_domain'),
            'projectId' => config('services.firebase.project_id'),
            'storageBucket' => config('services.firebase.storage_bucket'),
            'messagingSenderId' => config('services.firebase.messaging_sender_id'),
            'appId' => config('services.firebase.app_id'),
        ]);
    }

    public function storeToken(Request $request){
        $user = Auth::user();
        $user->fcm_token = $request->fcm_token;
        $user->save();

         return response()->json(['message'=>'token save']);
    }

    // public function sendNotification(){

    //         // Firebase Cloud Messaging endpoint
    //         $fcmEndpoint = 'https://fcm.googleapis.com/fcm/send';

    //         // Firebase server key obtained from Firebase Console
    //         $serverKey = 'AAAAxtqO9nY:APA91bHbhEs10EwI_VM2kDWBz7-0OOc_cYprYFEfAVbuMZ1YZeurHD5lFUdlkaRfcpBxu1-rHTnop4ZbcrqMAAfuLpV7pOezSPz2PAWAbqPKpA27NuPDNByey_0lN3VmnHHxJAHLJ68U';


    //         $fcmTokens = User::pluck('fcm_token');

    //         // Notification payload
    //         $notification = [
    //             'title' => 'Title',
    //             'body' => 'Body',
    //         ];

    //         // Data payload (optional)
    //         $data = [
    //             'key' => 'value',
    //         ];

    //         // Build the request body for each FCM token
    //         $requests = [];
    //         foreach ($fcmTokens as $fcmToken) {
    //             $requests[] = [
    //                 'notification' => $notification,
    //                 'data' => $data,
    //                 'to' => $fcmToken,
    //             ];
    //         }

    //         // Send notifications via API call
    //         $client = new Client();
    //         $responses = [];
    //         foreach ($requests as $body) {
    //             $response = $client->post($fcmEndpoint, [
    //                 'headers' => [
    //                     'Authorization' => 'key=' . $serverKey,
    //                     'Content-Type' => 'application/json',
    //                 ],
    //                 'json' => $body,
    //             ]);
    //             $responses[] = $response;
    //         }

    //         // Handle responses
    //         $successCount = 0;
    //         foreach ($responses as $response) {
    //             if ($response->getStatusCode() === 200) {
    //                 $successCount++;
    //             }
    //         }

    //         return response()->json(['message' => "$successCount notifications sent successfully"]);

    // }
    public function sendNotification()
	    {

	        $data=[];
	        $data['message']= "Some message";

	        $data['booking_id']="my booking booking_id";

            $tokens = [];
         return   $tokens[] = User::whereNotNull('fcm_token')->pluck('fcm_token');
	        $response = $this->sendFirebasePush($tokens,$data);

	    }
        public function sendFirebasePush($tokens, $data)
	    {

	        $serverKey = 'AAAAxtqO9nY:APA91bHbhEs10EwI_VM2kDWBz7-0OOc_cYprYFEfAVbuMZ1YZeurHD5lFUdlkaRfcpBxu1-rHTnop4ZbcrqMAAfuLpV7pOezSPz2PAWAbqPKpA27NuPDNByey_0lN3VmnHHxJAHLJ68U';

	        // prep the bundle
	        $msg = array
	        (
	            'message'   => $data['message'],
	            'booking_id' => $data['booking_id'],
	        );

	        $notifyData = [
                 "body" => $data['message'],
                 "title"=> "Port App"
            ];

	        $registrationIds = $tokens;

	        if(count($tokens) > 1){
                $fields = array
                (
                    'registration_ids' => $registrationIds, //  for  multiple users
                    'notification'  => $notifyData,
                    'data'=> $msg,
                    'priority'=> 'high'
                );
            }
            else{

                $fields = array
                (
                    'to' => $registrationIds[0], //  for  only one users
                    'notification'  => $notifyData,
                    'data'=> $msg,
                    'priority'=> 'high'
                );
            }

	        $headers[] = 'Content-Type: application/json';
	        $headers[] = 'Authorization: key='. $serverKey;

	        $ch = curl_init();
	        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
	        curl_setopt( $ch,CURLOPT_POST, true );
	        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
	        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	        // curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
	        $result = curl_exec($ch );
	        if ($result === FALSE)
	        {
	            die('FCM Send Error: ' . curl_error($ch));
	        }
	      return  curl_close( $ch );
	        return $result;
	    }

}
