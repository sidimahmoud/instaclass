<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Rest\Client;

class LiveCoursesController extends Controller
{
    public function generate_token($myRoom, $user)
    {
        // Substitute your Twilio Account SID and API Key details
        $accountSid = env('TWILIO_ACCOUNT_SID');
        $apiKeySid = env('TWILIO_API_KEY');
        $apiKeySecret = env('TWILIO_API_SECRET');
        $identity = $user . "-" . uniqid();
        // Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );
        // Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom($myRoom);
        $token->addGrant($grant);
        // Serialize the token as a JWT
        return $token->toJWT();
    }

    public function createRoom($myRoom, $user, $recorded)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $apiKeySid = env('TWILIO_API_KEY');
        $apiKeySecret = env('TWILIO_API_SECRET');

        $twilio = new Client($sid, $token);
        $room = $twilio->video->v1->rooms
            ->create([
                "recordParticipantsOnConnect" => $recorded,
                "type" => "group",
                "uniqueName" => $myRoom,
            ]
            );
        // Grant access to Video
        $identity = "teacher-identity";
        // Create an Access Token
        $myToken = new AccessToken(
            $sid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );
        $grant = new VideoGrant();
        $grant->setRoom($myRoom);
        $myToken->addGrant($grant);
        return response()->json([
            "sid" => $room->sid,
            "name" => $room->uniqueName,
            "token" => $myToken->toJWT(),
            "duration" => $room->duration]);
    }

    public function roomDetails($myRoom)
    {
        try {
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_ACCOUNT_TOKEN');
            $twilio = new Client($sid, $token);
            $room = $twilio->video->v1->rooms($myRoom)->fetch();
            Log::info("success");
            return response()->json([
                "name" => $room->uniqueName,
                "sid" => $room->sid,
                "status" => $room->status,
                "recorded" => $room->recordParticipantsOnConnect,
                "start" => $room->dateCreated,
                "end" => $room->endTime,
                "max_participants" => $room->maxParticipants,
                "duration" => $room->duration]);
        } catch (\Throwable $e) {
            Log::info("error");
            Log::info($e);
            return [];
        }
    }

    public function roomRecordings($roomSid)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $twilio = new Client($sid, $token);

        $recordings = $twilio->video->v1->rooms($roomSid)
            ->recordings
            ->read([], 20);

//        foreach ($recordings as $record) {
        //            print($record->sid);
        //        }
        return response()->json($recordings);
    }

    public function roomParticipants($roomSid)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $client = new Client($sid, $token);

        $participants = $client->video->rooms($roomSid)
            ->participants->read(array("status" => "connected"));
//        foreach ($participants as $participant) {
        //            echo $participant->identity;
        //        }
        return response()->json($participants);
    }

    public function closeRoom($myRoom)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $twilio = new Client($sid, $token);
        $room = $twilio->video->v1->rooms($myRoom)
            ->update("completed");
        return response()->json("Room completed");
    }
    public function removeParticipant($roomSid, $user)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $client = new Client($sid, $token);
        $participant = $client->video->rooms($roomSid)
            ->participants($user)
            ->update(array("status" => "disconnected"));
        return response()->json(["status" => $participant->status, "user" => $participant->identity]);
    }

    public function myRooms($uniqueName)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $twilio = new Client($sid, $token);
        $rooms = $twilio->video->v1->rooms->read(["uniqueName" => $uniqueName], 20);
//        echo $rooms;
        return response()->json($rooms);
    }

    public function retrieveRoomsbyStatus($status)
    {
        try {
            $sid = env('TWILIO_ACCOUNT_SID');
            $token = env('TWILIO_ACCOUNT_TOKEN');
            $twilio = new Client($sid, $token);
            $rooms = $twilio->video->v1->rooms->read(["status" => $status], 20);
            $final_json = [];
            foreach ($rooms as $v) {
                $item['sid'] = $v->sid;
                $item['uniqueName'] = $v->uniqueName;
                $item['dateCreated'] = date_format($v->dateCreated, "Y-m-d H:i:s");
                $final_json[] = $item;
            }
            return response()->json($final_json);
        } catch (\Throwable $e) {
            Log::info("error" . $e);
            return [];
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
