echo "Running Migration Wizard..."
php artisan migrate:refresh --path=./database/migrations/access_controls
php artisan migrate:refresh --path=./database/migrations/misc
php artisan migrate:refresh --path=./database/migrations/masters
php artisan migrate:refresh --path=./database/migrations/transactions

echo "Migrations Refreshed. Looking for seeds."
php artisan db:seed
echo "Migrations Refreshed and Seeded."
