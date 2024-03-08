# food delivery app rest api
In this project, I have implemented a basic food delivery app REST API using Laravel and Docker in the local environment, utilizing the LAMP stack. This stack includes Apache, MySQL, PHP 8.2, and phpMyAdmin

## Project Installation guide and run process

Step-1. ```git clone https://github.com/mamunurrashid1010/food-delivery-app-rest-api.git ```<br>
Step-2. Go to project directory ```cd food-delivery-app-rest-api ``` <br>
Step-3. Create file ```.env``` or copy from ```.env.example``` <br>
Step-4. Open ``` .env ``` file and update
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=foodDeliveryApp_db
DB_USERNAME=root
DB_PASSWORD=
```

Step-5. Run command ```docker compose up -d``` <br>
Step-6. Run command ``` docker-compose exec app composer install``` <br>
Step-7. Run command ``` docker-compose exec app php artisan migrate``` <br>

You can see the project on ```http://127.0.0.1:8000``` <br>
And your ```database (phpMyAdmin)``` on ```http://127.0.0.1:3400```


Stop and remove containers, networks, images, and volumes run ```docker compose down```

