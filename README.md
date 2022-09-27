# docker-compose PHP MariaDB slim4 Boilerplate

1. start and get logs

```
docker-compose up
```

2. open an new terminal and get into PHP container

```
docker-compose exec --workdir /app php /bin/bash
```

3. within the PHP container, install compose dependencies

```
composer update
```

4. slim app runs on http://localhost:8080