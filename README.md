## Requirement

-   php 8.x.x
-   Laravel 11
-   composer 2.7.x
-   mysql

## Package

tymon/jwt-auth

## Validation

[
'name' => 'required|string|max:225',
'email' => 'required|string|email|max:255|unique:users',
'password' => 'required|string|min:8',
'role_id' => 'required|integer',
]

<h3>Documentation API</h3>

Header:{
"Accept":"application/json",
"Content-Type":"application/json",
}
Authentication:Barier

## POST /api/v1/auth/logout

    body    : None

## POST api/v1/login

    body: {
        email,
        password
    }

## POST api/v1/user/store

    body    :{
        name,
        email,
        password,
        role_id
    }

## POST api/v1/user/update

    body    :{
        id,
        name,
        email,
        password,
        role_id
    }

## GET api/v1/user

    params:{
        search,
        sort,
        perPage
    }

## GET|HEAD api/v1/user/getByID/{id}

    params:{
        id
    }

## DELETE api/v1/user/delete/{id}

    params:{
        id
    }
