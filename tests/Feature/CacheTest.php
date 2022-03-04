<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheTest extends TestCase
{
    use DatabaseMigrations;
    /** @test **/
    public function test_posts_are_cached_when_command_is_run()
    {
        // clear cache
//        $this->prepareForTesting();

        $this->assertFalse(Cache::has('posts_asc'));
        $this->assertFalse(Cache::has('posts_desc'));

        $this->artisan('cache:posts');

        $this->assertTrue(Cache::has('posts_desc'));
        $this->assertTrue(Cache::has('posts_asc'));
    }

    public function prepareForTesting()
    {
        Artisan::call('cache:clear');
    }
}
