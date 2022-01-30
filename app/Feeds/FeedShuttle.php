<?php

namespace App\Feeds;

use App\Exceptions\ShuttleFailedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

class FeedShuttle
{
    protected const URLS = [
        'posts' => 'posts'
    ];


    protected static function http(): Client
    {
        return new Client([
            'base_uri' => config('services.blog-feed.base_url')
        ]);
    }

    /**
     * @throws \Exception
     */
    protected static function request(string $uri): \Psr\Http\Message\ResponseInterface
    {
        try {
            $response = self::http()->get($uri);

        }catch (GuzzleException $exception){

            $errorMessage = $exception->getMessage();

            Log::error('Feed fetch error - '.$errorMessage());

            //TODO - Handle via ShuttleFailedException - throw meaningful error
            throw new \Exception($exception->getMessage());
        }

        return $response;
    }

    /**
     * @throws \Exception
     */
    public static function getBlogPosts(): string
    {
        $response = self::request(static::URLS['posts']);

        return $response->getBody()->getContents();
    }
}
