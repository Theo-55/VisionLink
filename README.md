## Local Setup

This project was setup using laravel, Inertia, and Vue.js. Herd is reccomended for the local laravel setup

Node Version >= 20.0
PHP Version >= 8.0

1. Clone repository to local device
2. Composer install as well as node install
3. Setup local env file to match local setup, should only need your own db credentials
4. Run php artisan migrate:fresh --seed (may need to be re-run if duplicates are randomly created)
5. Run npm run dev to show project in web browser
