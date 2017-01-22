# HoneyPot API
The HoneyPot API exposing data.

## Quick Start

- Clone this repo or download it's release archive and extract it somewhere
- You may delete `.git` folder if you get this code via `git clone`
- Run `composer install`
- Run the server from the root project `php -S localhost:8081 -t ./public`


## API 

### Authentication
To authenticate a user, make a `POST` request to `/api/auth/login` with parameter as mentioned below:

```
email: johndoe@example.com
password: johndoe
```

Response:
```
{
  "success": {
    "message": "token_generated",
    "token": "a_long_token_appears_here"
  }
}
```
The token is needed for all the following requests has `GET` parameter : `/api/something?token=abc`.

### Objectives
Objectives are budgets that need to be completed. They can be nested. They have a label, a goal (amount of money needed), a deadline (a timestamp) and a parentObjectId.

#### getAll
To fetch all objectives, make a `POST` request to `/api/objectives/all` with no argument.

#### getByID
To fetch a specific objective, make a `POST` request to `/api/objectives/get/{id}` with no argument.

#### create
To fetch a specific objective, make a `POST` request to `/api/objectives/create/{id}` with the following arguments :

```
{   
    "label" : "Vacations in Hawai",    
    "goal" : 4500.00,    
    "deadline" : 1485099862	,    
    "parent_objective_id" : 1 
}
```
The JSON data need to be sent with name `data`.

#### update
To fetch a specific objective, make a `POST` request to `/api/objectives/update/{id}` with the following arguments :

```
{   
    "id" : 4,    
    "label" : "Vacations in Hawai",    
    "goal" : 4000.00,    
    "deadline" : 1505099862	,    
    "parent_objective_id" : 1 
}
```
The JSON data need to be sent with name `data`. Don't forget the `id` parameter !

#### delete
To delete a specific objective, make a `POST` request to `/api/objectives/delete/{id}` with no argument.
