<?php

namespace Tests\Feature;

use App\Events\BlogPostHasBeenCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_unauthenticated_user_can_view_blogs()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Publication Date');
        $response->assertSee('Login');
        $response->assertSee('Register');
    }

    public function test_only_authenticated_can_create_blogs()
    {
        $response = $this->get(route('post.create'));

        $response->assertRedirect(route('login'));
        $response->assertDontSee('Create Post');

        $data =  [
            'title' => 'Lorem Ipsum Title Test',
            'description' => 'Laravel provides several database assertions for your',
        ];

        $response = $this->post(route('post.store'), $data);
        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('blog_posts', $data);

        $this->post('/register', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        Event::fake();
        $response = $this->post(route('post.store'), $data);
        Event::assertDispatched(BlogPostHasBeenCreated::class);

        $response->assertRedirect(route('posts.user'));
        $this->assertDatabaseHas('blog_posts',  $data);
    }
}
