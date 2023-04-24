## Sobre o Listra

Projeto simples para demonstração de simulação de financiamento de veículo


#### Backend - Setup

```sh
jonathan@notebook:~$ cd backend/
jonathan@notebook:~$ docker-compose up -d --build
jonathan@notebook:~$ docker exec -it  backend_backend_1 /bin/bash
eac0e87c9bfe:/var/www/html# cp .env.example .env
eac0e87c9bfe:/var/www/html# composer install
eac0e87c9bfe:/var/www/html# php artisan migrate
eac0e87c9bfe:/var/www/html# php artisan db:seed
```

```
port 8000
```

#### Frontend - Setup

```sh
jonathan@notebook:~$ cd frontend/
jonathan@notebook:~$ docker-compose up -d --build
```

```
port 8080
```
