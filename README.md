
## Testing requirements 📝

You will need:

- Docker with docker-compose
- Postman (to test the API)


## Starting up 🚀

Make sure you get everything needed from [here](https://github.com/Salad-0098/mulhacen/).

Once cloning the repository you should get a `docker-compose.yml` file. Navigate there and run:

```shell
docker-compose up -d
```

## Testing the api 🐛

### Requests

You will need to generate a bearer token before doing any request besides creating a doctor, getting a doctor's data or generating the token itself. Make sure you call `$YOUR_URL/token/{doctor_id}`. This will return your api key ***only once***. Make sure you write it down. After that, you can attach it as a bearer token on all requests to proceed testing.

There's attached at the root of the repository two files, `Dev.postman_environment.json` and `Prueba.postman_collection.json` for the environment and the endpoints so you can test with Postman more easily.

### Tests

To run the tests, get into the `laravel_app` container's cli and run `php artisan test`. Before doing so you should make sure you set a valid Bearer Token.