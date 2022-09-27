# UnLock
[Tristan BELMONT](https://github.com/MaegIins)  
[Kévin BULLY CIMBALURIA](https://github.com/TheRealEureka)  
[Lucas FARRONI](https://github.com/lucasfarroni)  
[Clément PERRIN](https://github.com/Alfiov)  

# Installer Docker et composer

1. Start and get logs

```
docker-compose up
```

2. Open an new terminal and get into PHP container

```
docker-compose exec --workdir /app php /bin/bash
```

3. Within the PHP container, install compose dependencies

```
composer update
```

4. Slim app runs on http://localhost:8080
