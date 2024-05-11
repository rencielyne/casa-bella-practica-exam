**After cloning the project, kindly follow these steps if need to check the functionality:**

- Run `composer install`
- Copy the file `.env.example` in the root directory and rename as `.env`
- Run `php artisan key:generate`
- Change these values in the .env file into your database connection
  
  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=
  DB_DATABASE=
  DB_USERNAME=
  DB_PASSWORD=
  ```
- Change also the `APP_URL=http://localhost` into `APP_URL=http://127.0.0.1:8000` in .env file as well and save.
- After the change in .env, kindly run these artisan commands:
  ```
  php artisan storage:link
  php artisan config:clear
  php artisan migrate
  php artisan serve
  ```
- Then finally, on a different terminal, run the `npm run build`


Thank you!
