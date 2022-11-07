# PHP Challenge 

* Complete Crud for hotels, rooms , roomsTypes under auth middleware 
* Generate data from seeder to countries ,cities and other entities 
* Store the movies and categories using mysql database
* end points for all cruds and search with hotels and filtering with rating 
* Can filter the result by some parameters for example filter by hotel name , city name ,
  country iso , price
  
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

Link of postman collection https://www.getpostman.com/collections/b8c5725741ba5c234951 


* Register new user   http://127.0.0.1/api/register/
* Login user :  http://127.0.0.1/api/user/

* List of hotels endpoint:  http://127.0.0.1/api/hotels/
* Create new hotel :  http://127.0.0.1/api/hotels/
* Update new new hotel :  http://127.0.0.1/api/hotels/{hotel}
* Delete hotel :  http://127.0.0.1/api/hotels/{hotel}
* Show hotel :  http://127.0.0.1/api/hotels/{hotel}
* Available search parameters:  [name, city_name , country, country, price , and filtering by rating ]
* example 
 ```
{
    "payload": {
        "data": [
            {
                "name": "New Stars",
                "description": "New Description",
                "city": {
                    "name": "Cyrilfort"
                },
                "rating": 5,
                "rooms": [
                    {
                        "name": "Single Plus",
                        "description": "New Description",
                        "price": "500.00",
                        "roomType": {
                            "size": 1
                        }
                    },
                    {
                        "name": "single",
                        "description": "Sunt illum a esse sed.",
                        "price": "117.00",
                        "roomType": {
                            "size": 2
                        }
                    },
                    {
                        "name": "single",
                        "description": "Et et voluptates blanditiis placeat voluptatem et saepe.",
                        "price": "356.00",
                        "roomType": {
                            "size": 1
                        }
                    },
                    {
                        "name": "single",
                        "description": "Iste enim excepturi enim id.",
                        "price": "465.00",
                        "roomType": {
                            "size": 3
                        }
                    },
                    {
                        "name": "Single Plus",
                        "description": "Single description",
                        "price": "450.00",
                        "roomType": {
                            "size": 1
                        }
                    }
                ]
            }
        ],
        "links": {
            "first": "http://127.0.0.1/api/hotels?page=1",
            "last": "http://127.0.0.1/api/hotels?page=50",
            "prev": null,
            "next": "http://127.0.0.1/api/hotels?page=2"
        },
        "meta": {
            "current_page": 1,
            "from": 1,
            "last_page": 50,
            "links": [
                {
                    "url": null,
                    "label": "&laquo; Previous",
                    "active": false
                },
                {
                    "url": "http://127.0.0.1/api/hotels?page=1",
                    "label": "1",
                    "active": true
                },
                {
                    "url": "http://php-challange.test/api/hotels?page=2",
                    "label": "Next &raquo;",
                    "active": false
                }
            ],
            "path": "http://127.0.0.1/api/hotels",
            "per_page": 1,
            "to": 1,
            "total": 50
        }
    },
    "status": "true",
    "message": "",
    "code": 200
}
```

## also we have list of rooms crud end points
* List of rooms endpoint:  http://127.0.0.1/api/rooms/
* Create new room :  http://127.0.0.1/api/rooms/
* Update  room :  http://127.0.0.1/api/rooms/{room}
* Delete room :  http://127.0.0.1/api/rooms/{room}
* Show room :  http://127.0.0.1/api/rooms/{room}


## and we have list of room types crud end points 
* List of rooms endpoint:  http://127.0.0.1/api/room-types/
* Create new room type :  http://127.0.0.1/api/room-types/
* Update  room type :  http://127.0.0.1/api/room-types/{room_type}
* Delete room type :  http://127.0.0.1/api/room-types/{room_type}
* Show room type  :  http://127.0.0.1/api/room-types/{room_type}


