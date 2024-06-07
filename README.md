## About the project

This is a Laravel application that uses Inertia.js and Vue.js. I set it up with the Laravel Breeze Starter Kit.

You'll need to run

```sh
composer install
npm install
```

php artisan migrate:fresh --seed (this will seed with one user, one list, and 10 items for that list)

Start the server

```sh
php artisan serve
```

Start vite

```sh
npm run dev
```

Login with

-   test@example.com
-   secret123

All functionality sits within the Dashboard view.

## Comments

I managed to complete 2 of the stories within the 6 hours allowed (although stories 5 and 10 seem to be covered by the work done for 1 and 2). I had some issues setting up the jest configuration to work with vue3, and lost at least an hour on that. Inertia has also added another layer that makes jest testing slightly more complicated than I had anticipated. I've only just discovered Inertia and really wanted to give the monolith a go, so that slowed me down a bit as well.

There are two open pull requests, story 1 and story 2, to make it easier to see the work committed per story.

I feel like I didn't have enough time to do all the stories I intended to do, so I will commit more work over the weekend. You can ignore those commits if not allowed.
