# Coding Collective Test

## Instalasi API with Docker

```
git clone https://github.com/ekowebdev/codingcollective-test.git
cd codingcollective-test/api
cp .env.example .env
docker-compose up -d --build
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate --seed
docker-compose exec php php artisan queue:work --tries=3
```

## Instalasi Web/GUI with Docker

```
git clone https://github.com/ekowebdev/codingcollective-test.git
cd codingcollective-test/web
cp .env.example .env
docker-compose up -d --build
```