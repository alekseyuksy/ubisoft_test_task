## Setup
Please do next commands:

docker-compose up --build

docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed

## SignIn
login: test_{number from 1 to 70}@material.com
password: secret
