# PHP Challenge 

* Complete Crud for hotels, rooms , roomsTypes 
* Generate data from seeder to countries ,cities and other entities 
* Store the movies and categories using mysql database
* end points for all cruds and search with hotels
* Can filter the result by some parameters for example filter by hotel name , city name ,
  country iso , price
* Can sort the result by some parameters for example sort by most high price desc


## installation
All the code required to get started
## Clone
Clone this repo to your local machine using https://github.com/salmazz/movies-api.git
and run
```
git clone https://github.com/salmazz/movies-api.git
cd hotels_api
cp .env.example .env
composer install
composer dumpautoload
```

## Environment
Setup env and add your credentials in .env file

## Database
Setup new Database named "hotels_api"

## Docker
Run Docker Desktop app first

# Laravel sail
run  ./vendor/bin/sail up -d to setup environment by docker
```
./vendor/bin/sail up -d
```

## Run Migrations
```bash
 ./vendor/bin/sail artisan migrate --seed
 ````
## Testing

```
./vendor/bin/sail artisan test
````

## APIs
