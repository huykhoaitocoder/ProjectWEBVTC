<?php

namespace App\Http\Controllers\backend;

use Google\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class YouTubeController extends Controller
{
    public function handleCallback(Request $request)
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('youtube_client_secret.json'));
        $client->addScope("https://www.googleapis.com/auth/youtube.upload");
        $client->setRedirectUri(url('/auth/youtube/callback'));
        $client->setAccessType('offline');

        $authCode = $request->get('code');

        if (!$authCode) {
            return response()->json(['error' => 'No auth code found'], 400);
        }

        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);

        file_put_contents(storage_path('youtube_token.json'), json_encode($accessToken));

        return redirect('/')->with('success', 'YouTube authentication successful!');
    }
}
