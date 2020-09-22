<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class FCMService
{
    private $serverKey = 'key=AAAAoh-iEjo:APA91bEKvF0zkeWhzMvOrnZ7jrXHsfKAGdeo9ATGT2AdpdN0fDUO2Yos8Dku3MQxcmyU8rcI1UIAPa9pWVtkDGKylEamh2UPcX181VgUsFzwS-rEdnqnLzPBQaTDOMhHtbmj1INqiuMg';
    private $projectId = '696315417146';
    private $client;
    private $user;

    public function __construct($user)
    {
        // $this->client = new Client();
        $this->user = $user;
    }

    public function saveToken($request) {
        $this->user->update([
            'notif_token' => $request->notif_token,
        ]);
    }

    public function checkGroup() {
        $user = DB::connection('system')->table('users')
            ->where('email', $this->user->email)
            ->first();

        // $result = $this->client->get('https://fcm.googleapis.com/fcm/notification?notification_key_name='.$user->notif_group_id, [
        //     'http_errors' => false, // or using try catch to handling client error, ie 400 bad request
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //         'Authorization' => $this->serverKey,
        //         'project_id' => $this->projectId
        //     ]
        // ]);

        //using curl
        // $payload = json_encode($params);
        $ch = curl_init('https://fcm.googleapis.com/fcm/notification?notification_key_name='.$user->notif_group_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $this->serverKey,
            'project_id: ' . $this->projectId
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        // return array_key_exists('notification_key', $result) ? $result->notification_key : false;
        $data = json_decode($result);
        if(isset($data->notification_key)) {
            return $data->notification_key;
        }

        return false;
    }

    public function setGroup(array $regIds) {
        $user = DB::connection('system')->table('users')
            ->where('email', $this->user->email)
            ->first();

        $groupKey = $this->checkGroup();
        if($groupKey) {
            $params = [
                "operation" => "add",
                "notification_key_name" => $user->notif_group_id,
                "notification_key" => $groupKey,
                "registration_ids" => $regIds
            ];
        } else {
            $params = [
                "operation" => "create",
                "notification_key_name" => $user->notif_group_id,
                "registration_ids" => $regIds
            ];
        }

        // $result = $this->client->post('https://fcm.googleapis.com/fcm/notification', [
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //         'Authorization' => $this->serverKey,
        //         'project_id' => $this->projectId
        //     ],
        //     'form_params' => $params
        // ]);

        // return $result;

        // using curl
        $payload = json_encode($params);
        $ch = curl_init('https://fcm.googleapis.com/fcm/notification');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $this->serverKey,
            'project_id: ' . $this->projectId
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function sendNotif(array $notif, $data = null) {
        // commented to send multi users
        // $user = DB::connection('system')->table('users')
        //     ->where('email', $this->user->email)
        //     ->first();

        $params = [
            // "to" => $user->notif_user_id,
            // "to" => $user->notif_group_id, // still error InvalidRegistration
            // "notification": [
            //     "title" => "FCM Message Test ok",
            //     "body" => "This is a message from FCM"
            // ],
            "registration_ids" => $this->user, // all user in a hostname
            // "to" => $this->user, // all user in a hostname
            "notification" => $notif,
            "data" => $data
        ];

        // $result = $this->client->post('https://fcm.googleapis.com/fcm/send', [
        //     'headers' => [
        //         'Content-Type' => 'application/json',
        //         'Authorization' => $this->serverKey
        //     ],
        //     'form_params' => $params
        // ]);

        // using curl
        $payload = json_encode($params);
        $ch = curl_init('https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: ' . $this->serverKey
        ));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
