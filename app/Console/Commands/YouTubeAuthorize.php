<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Client;

class YouTubeAuthorize extends Command
{
    protected $signature = 'youtube:authorize';
    protected $description = 'Authorize YouTube API and save access token';

    public function handle()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('youtube_client_secret.json'));
        $client->addScope("https://www.googleapis.com/auth/youtube.upload");
        $client->setRedirectUri('https://vhapk.com/auth/youtube/callback');
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        $authUrl = $client->createAuthUrl();
        $this->info("Mở URL sau trong trình duyệt để cấp quyền:\n$authUrl");

        $this->info("Sau khi xác thực, nhập mã xác thực ở đây:");
        $authCode = trim(fgets(STDIN));

        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        file_put_contents(storage_path('youtube_token.json'), json_encode($accessToken));

        $this->info("✅ Đã lưu token vào storage/youtube_token.json");
    }
}
