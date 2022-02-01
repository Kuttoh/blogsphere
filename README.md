### Getting started
- Get repo by cloning:  `git clone git@github.com:Kuttoh/blogsphere.git`
- cd into `blogsphere`
- Run `composer install`
- Create database with specified name in `.env` i.e.`blogsphere`
- Run migrations: `php artisan migrate`
- Seed database: `php artisan db:seed`
- Install dependencies `npm install && npm run dev`
- Serve the project on local
- You can register user and create blogs as you please

### Testing
- Simply run `phpunit --testdox` for detailed info

### Integration
- To fetch blog posts by command, run `php artisan posts:fetch`

### Cache
- By default, first request will cache blog post data
- To re-cache run `php artisan cache:posts`

NB: Creation of posts will dispatch events to update cached posts

Thank you!
