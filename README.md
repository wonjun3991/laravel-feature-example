# Installation

## 키 생성 및 도커 구동

```shell
cp .env.example .env
docker compose up -d
docker compose exec workspace php artisan key:generate
```

## DB 세팅

```mysql
docker compose exec mariadb mysql -u root -p
GRANT ALL ON laravel.* TO 'laravel'@'%' IDENTIFIED BY 'laravel';
FLUSH PRIVILEGES;
```

## 실행

```shell
docker compose exec workspace php artisan migrate
docker compose exec workspace php artisna db:seed
docker compose exec -d workspace php artisan serve --host 0.0.0.0
```

## 테스트

```shell
docker compose exec workspace php artisan test
```


