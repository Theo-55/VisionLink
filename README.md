## Local Setup

This project was setup using laravel, Inertia, and Vue.js. Herd is reccomended for the local laravel setup

Instructions to install herd are here:
[Herd](https://herd.laravel.com/docs/1/getting-started/installation)

The best way to handle this setup is once herd is up and running, navigate to the project directory locally and run ``` herd link ``` to link herd to that directory. 

Node Version >= 20.0
PHP Version >= 8.0

1. Clone repository to local device
2. Composer install as well as node install
3. Setup local env file to match local setup, should only need your own db credentials
4. If herd is successfully installed, you will need to add '.test' to the local APP_URL 
5. Run ``` php artisan migrate:fresh --seed``` (may need to be re-run if duplicates are randomly created)
6. Run ``` npm run dev``` to show project in web browser

If the migrations ran and your projet built, you should be set! 
