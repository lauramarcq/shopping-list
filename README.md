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

Testing

```sh
./vendor/bin/phpunit
```

```sh
npm test
```

All functionality sits within the Dashboard view.

## Comments

I managed to complete 2 of the stories within the 6 hours allowed. I had some issues setting up the jest configuration to work with vue3, and lost at least an hour on that. Inertia has also added another layer that makes jest testing slightly more complicated than I had anticipated. I've only just discovered Inertia and really wanted to give the monolith a go, so that slowed me down a bit as well.

There are two open pull requests, story 1 and story 2, to make it easier to see the work committed per story.

I feel like I didn't have enough time to do all the stories I intended to do, so I will commit more work over the weekend. You can ignore those commits if not allowed.

## Weekend Update

I continued working on story 3 and 4 on and off over the weekend.

Story 4 really needs story 5 in order to work properly. I thought of installing Vuex and setting up a store to persist and mutate the sate, but it's now Sunday afternoon and I'm calling it a day.

### How would I do the remainig tasks

-   task 6: install a library like Vue Draggable and watch the changes. The change would trigger a post request. The backend would require a migration to add an order column in the items table, update the model, and add a method to handle that request in the controller.

-   task 7: as I have already created a price column in the items table I would just need to add up the total of all the items with a computed property and display it at the bottom of the ItemTable component. To save this total amount, watch changes in the computed property and trigger a post/patch request when there's a change and then in the back end I would need to add a current_total column to the lists table and update the model, and controller.

-   task 8: migration to add another column to the lists table (max_total), and in the UI allow the user to add a max budget when creating the list. Display that total in the EditList view and track the currentTotal prop from task 7 to cap the requests when it reaches the budget limit, probably setup a dialog or snackbar to alert the user that no more items can be added.

-   task 9: Not entirely sure about this one. I suppose a button in the front end could trigger a post request to a new endpoint to handle the list. I know laravel has mailing functionality but I'm not familiar with it.

-   task 10: I believe it's already done in task 1.
