<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

## TDD ToDo App

This is an example project implementing a single small feature of a ToDo app as described by the below scenario: 

*As a User, I want to have an ability able to see a list of Tasks for my day, so that I can do them one by one.*

The implementation consists of a single API endpoint. It returns a simple JSON representation of a list of Tasks:

- belonging to the User as identified by the API Key
- not completed
- planned for "today" or without a specified date

The implementation is OOP based and executed using the TDD approach. 


## Installation

**This app is based on Laravel 7 and requires PHP >= 7.4**

Clone the repository

`git clone git@github.com:Gadoma/ToDo.git ToDo`

Setup .env 

```
APP_NAME=ToDo
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=user
DB_PASSWORD=pass
```

Generate a unique app key 

`php artisan key:generate`

Setup the database structure 

`php artisan migrate`

Seed the database with example data

`php artisan db:seed`

## Usage

Once the database is seeded there will be some example data to play around with - two Users with some Tasks will be created with the following API keys:

- `1111111111` (for User 1)
- `2222222222` (for User 2)

To authorize the API requests, the key (token) needs to be passed in the request header, e.g.

`Authorization: Bearer 1111111111` 

By default the API is throttled to 60 req/min.

## Example

```
$ curl -i -H "Accept: application/json" -H "Authorization: Bearer 1111111111" http://localhost/api/v1/tasks

HTTP/1.1 200 OK
Server: nginx/1.15.8
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
Cache-Control: no-cache, private
Date: Wed, 27 May 2020 09:02:25 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59

[
    {
        "id": 6,
        "title": "Fugiat quis.",
        "description": "Alice timidly. 'Would you tell me,' said Alice, as the game was in a tone of great relief. 'Now at OURS they had been broken to pieces. 'Please, then,' said Alice, seriously, 'I'll have nothing more.",
        "planned_at": "2020-05-27T00:00:00.000000Z",
        "completed_at": null,
        "user_id": 1,
        "created_at": "2020-05-26T11:23:03.000000Z",
        "updated_at": "2020-05-26T11:23:03.000000Z"
    },
    {
        "id": 7,
        "title": "Rerum qui.",
        "description": "In a little pattering of footsteps in the sea!' cried the Gryphon, before Alice could hear the name 'Alice!' CHAPTER XII. Alice's Evidence 'Here!' cried Alice, quite forgetting that she tipped over.",
        "planned_at": "2020-05-27T00:00:00.000000Z",
        "completed_at": null,
        "user_id": 1,
        "created_at": "2020-05-26T11:23:03.000000Z",
        "updated_at": "2020-05-26T11:23:03.000000Z"
    },
    {
        "id": 8,
        "title": "Nesciunt dicta ut.",
        "description": "Gryphon, and the constant heavy sobbing of the bill, \"French, music, AND WASHING--extra.\"' 'You couldn't have done that, you know,' said Alice, 'but I must be kind to them,' thought Alice, 'as all.",
        "planned_at": null,
        "completed_at": null,
        "user_id": 1,
        "created_at": "2020-05-26T11:23:03.000000Z",
        "updated_at": "2020-05-26T11:23:03.000000Z"
    },
    {
        "id": 9,
        "title": "Blanditiis distinctio.",
        "description": "I'll get into that lovely garden. I think I can kick a little!' She drew her foot as far down the chimney, has he?' said Alice timidly. 'Would you tell me, please, which way she put them into a.",
        "planned_at": null,
        "completed_at": null,
        "user_id": 1,
        "created_at": "2020-05-26T11:23:03.000000Z",
        "updated_at": "2020-05-26T11:23:03.000000Z"
    },
    {
        "id": 10,
        "title": "Quasi quae labore.",
        "description": "Alice! when she got up this morning, but I think it so quickly that the Queen furiously, throwing an inkstand at the window, and one foot up the fan and a sad tale!' said the Hatter, 'or you'll be.",
        "planned_at": null,
        "completed_at": null,
        "user_id": 1,
        "created_at": "2020-05-26T11:23:03.000000Z",
        "updated_at": "2020-05-26T11:23:03.000000Z"
    }
]
```

## Next steps
Besides adding new features the following improvements could be implemented in the future:

- switching from `INT` to `UUID` as entity identifiers to decouple ID generation from the database
- implementing `Transformers`/`Presenters` to have better control over data serialization/deserialization
- implementing `Validators` for incoming data
- switching from `ActiveRecord` to `DataMapper` to separate the models from the database

## Tooling

- **phpunit** - running tests 
- **phpstan** - static analysis 
- **php-cs-fixer** - code style

## License

&copy; 2020 Piotr Gadzinski

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
