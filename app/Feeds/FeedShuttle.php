<?php

namespace App\Feeds;

use App\Exceptions\ShuttleFailedException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class FeedShuttle
{
    protected const URLS = [
        'posts' => 'post'
    ];


    protected static function http(): Client
    {
        return new Client([
            'base_uri' => config('services.blog-feed.base_url')
        ]);
    }

    /**
     * @throws ShuttleFailedException
     */
    protected static function request(string $uri): \Psr\Http\Message\ResponseInterface
    {
        try {
            $response = self::http()->get($uri);

        }catch (GuzzleException $exception){

            $errorMessage = "Could not fetch posts from url: ".config('services.blog-feed.base_url')."/$uri"
                .PHP_EOL."Message: {$exception->getMessage()}";

            throw new ShuttleFailedException($errorMessage);
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
