<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait YoutubeHelperTrait
{
    public static function convertYouTubeUrl($url)
    {
        // Check if it's a youtu.be URL
        if (str_contains($url, 'youtu.be/')) {
            // Extract video ID from youtu.be URL
            $videoId = substr($url, strpos($url, 'youtu.be/') + 9);

            // Remove any query parameters (like ?si=...)
            if (str_contains($videoId, '?')) {
                $videoId = substr($videoId, 0, strpos($videoId, '?'));
            }

            // Return standard YouTube URL
            return 'https://www.youtube.com/watch?v='.$videoId;
        }

        return $url;
    }

    public static function getYouTubeVideoId($url): ?string
    {
        $url = self::convertYouTubeUrl($url);
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1]; // Video ID
        }

        return null;
    }

    public static function getYoutubeThumbnailUrl($videoId): string
    {
        return 'https://img.youtube.com/vi/'.$videoId.'/0.jpg';
    }

    public static function setThumbnailName(string $videoId): string
    {
        return 'thumbnail-'.$videoId.'.jpg';
    }

    public static function getVideoMeta(string $videoId): ?array
    {
        $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$videoId.'&key='.config('app.youtube_api_key');
        $response = Http::get($url);
        $json = [];
        if ($response->successful()) {
            $json = $response->json();
        }
        Log::info('cache youtube picker', [
            'json' => $json,
        ]);
        if ($json) {
            $thumbnail = $json['items'][0]['snippet']['thumbnails']['high']['url'] ?? '';
            $title = $json['items'][0]['snippet']['title'] ?? '';

            return compact('thumbnail', 'title');
        }

        return null;
    }
}
