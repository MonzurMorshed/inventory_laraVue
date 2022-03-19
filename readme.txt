composer create-project laravel/laravel:8.* inventory --prefer-dist
cd inventory
php artisan vendor:publish --tag=laravel-assets --ansi --force
npm install
npm install vue vue-router vue-axios --save
npm i vue-loader@next
npm install @meforma/vue-toaster
php artisan make:model Item -mcr
php artisan make:migration create_logs_table
php artisan make:migration add_itemId_to_logs
php artisan migrate
php artisan make:model Log
npm run watch