<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $identity = $user;
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

    public function createRoom($myRoom)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $twilio = new Client($sid, $token);
        $room = $twilio->video->v1->rooms
            ->create([
                    "recordParticipantsOnConnect" => True,
                    "statusCallback" => "https://instantclass.herokuapp.com/room-envents",
                    "type" => "group",
                    "uniqueName" => $myRoom
                ]
            );
        return response()->json(["name" => $room->uniqueName, "sid" => $room->sid, "duration" => $room->duration]);
    }

    public function roomDetails($myRoom)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $twilio = new Client($sid, $token);
        $room = $twilio->video->v1->rooms($myRoom)->fetch();
        return response()->json(["name" => $room->uniqueName, "sid" => $room->sid, "duration" => $room->duration]);
    }

    public function roomParticipants($roomSid)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $client = new Client($sid, $token);

        $participants = $client->video->rooms("DailyStandup")
            ->participants->read(array("status" => "connected"));
        foreach ($participants as $participant) {
            echo $participant->sid;
        }
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

    public function myRooms($uniqueName)
    {
        $sid = env('TWILIO_ACCOUNT_SID');
        $token = env('TWILIO_ACCOUNT_TOKEN');
        $twilio = new Client($sid, $token);
        $rooms = $twilio->video->v1->rooms->read(["uniqueName" => $uniqueName], 20);
//        echo $rooms;
        return response()->json($rooms);
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
