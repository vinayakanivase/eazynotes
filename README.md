# Eazynotes: A Laravel and VueJs based note app

![Homepage](/screenshots/1_homepage.png)


## Installation

1. Clone the repository by running the `git clone https://github.com/vinayakanivase/eazynotes.git` command.
2. Install required packages by running `composer install` command.
3. The `.env` file will be created once the composer installation is complete. If not, copy the `.env.example` and rename it to `.env`.
4. Make sure the `APP_KEY` is generated. If not, run the `php artisan key:generate` command to generate one.
5. Configure the `APP_URL` in `.env` file.
6. Create a database and set the credentials in the `.env` file.
7. Run `php artisan migrate` to create the database tables.
8. Once the tables are created, run `php artisan db:seed` to create dummy users and notes.
9. Run `php artisan serve` to run the app with PHP's in-built server.


## Features

![Features](/screenshots/2_features.png)

1. Sort the notes by ID (asc/desc).
2. Sort the notes by Title (asc/desc).
3. Sort the notes by Favorite state (asc/desc).
4. Reset the notes list.
5. Add new note. By default the note will be saved with dummy text (content and title).
6. Edit the Title for selected note.
7. Mark the selected note as Favorite.
8. Save the selected note.
9. Delete the selected note.
10. Logout from current session.
11. The light gray background indicates selected note.
12. The 'Heart' shape icon suggests a favorited note.
13. Note editor (textarea).
14. Live preview.


## Please note
This application is just a proof of concept and is not quite ready for production use. It needs a bit cleaning, and no tests are provided.


## Credits

[Unsplash](https://unsplash.com)


## License

Eazynotes is licensed under the [MIT license](https://opensource.org/licenses/MIT).
