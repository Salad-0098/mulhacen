
## Testing requirements 📝

You will need

- Docker with docker-compose
- Postman (to test the API)


## Starting up

Make sure you get everything needed from [here](https://github.com/Salad-0098/prueba/).

Once cloning the repository you should get a `docker-compose.yml` file. Navigate there and run:

```shell
docker-compose up -d
```

If everything went well, you should open the docker cli and run the migrations with:

```shell
php artisan migrate
```

This will create all the tables. For some quick testing, you can run the seeder, which will insert some fixed data, but ***it is completely optional***:

```shell
php artisan db:seed
```

In case you want to wipe everything from the database, you can either run `php artisan migrate:refresh` or delete the mariadb container, but that means you'll have to run the migrations and seeder again.

## Testing the api

You will need to generate a bearer token before doing any request besides creating a doctor, getting a doctor's data or generating the token itself. Make sure you call `$YOUR_URL/token/{doctor_id}`. This will return your api key ***only once***. Make sure you write it down. After that, you can attach it as a bearer token on all requests to proceed testing.

There's attached at the root of the repository two files, `Dev.postman_environment.json` and `Prueba.postman_collection.json` for the environment and the endpoints so you can test with Postman more easily.