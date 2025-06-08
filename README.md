# README

## REQUIREMENTS

- PHP 8.2
- MySQL
- Composer

## INSTALL
```bash
$ composer install
$ cp .env.example .env
```

## DATABASE MIGRATE & SEED
```bash
$ php console db:migrate
$ php console db:seed
```

Seeders are in PROJECT_PATH/database/seeders
Migrations in PROJECT_PATH/database/seeders

## RUN
On one terminal
```bash
$ php -S localhost:8000
```

On Another terminal (keep it open):
```bash
$ npm install
$ npm run watch:scss
```

## API

### Fetch User Movements

For user with id = 1
Api Key is => 286e72e79a69a3165bf913426c25221d51597349cd94fc2865b99fda050c2950

```bash
curl -X GET http://localhost:8000/api/clients/1 \
  -H "Authorization: Bearer 286e72e79a69a3165bf913426c25221d51597349cd94fc2865b99fda050c2950" \
  -H "Content-Type: application/json" 
```

## WEB

Open http://localhost:8000