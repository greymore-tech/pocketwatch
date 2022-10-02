echo "Running Migration Wizard..."
php artisan migrate --path=./database/migrations/access_controls
php artisan migrate --path=./database/migrations/misc
php artisan migrate --path=./database/migrations/masters
php artisan migrate --path=./database/migrations/transactions
echo "New Migration Added."

