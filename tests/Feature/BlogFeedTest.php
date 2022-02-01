<?php

namespace Tests\Feature;

use App\Feeds\FeedShuttle;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogFeedTest extends TestCase
{
//    use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function test_blog_feed_returns_data_in_valid_format()
    {
        $sample = json_encode([
            'data' => [
                'title' => 'Lorem Ipsum',
                'description' => 'Some long story',
                'publication_date' => now()->timestamp
            ]
        ]);

        $mock = $this->mock(FeedShuttle::class);

        $mock->shouldReceive('getBlogPost')
            ->andReturn(new Response(200, [], $sample));
    }
}
