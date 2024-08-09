# Coding Collective Test

## Instalation with Docker

```
git clone https://github.com/ekowebdev/codingcollective-test.git
cd codingcollective-test/api
cp .env.example .env
docker-compose up -d --build
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate --seed
docker-compose exec app php artisan queue:work --tries=3
```
