<?php

namespace App\Console\Commands;

use App\Exceptions\ShuttleFailedException;
use App\Exceptions\UserNotFoundException;
use App\Jobs\FetchBlogPosts;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DispatchFeedShuttle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to fetch posts from feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        try {
            FetchBlogPosts::dispatch();
        } catch (UserNotFoundException $exception){
           throw new UserNotFoundException($exception->getMessage());
        } catch (ShuttleFailedException $exception){
            throw new ShuttleFailedException($exception->getMessage());
        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
