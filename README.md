# UnLock
[Tristan BELMONT](https://github.com/MaegIins)  
[Kévin BULLY CIMBALURIA](https://github.com/TheRealEureka)  
[Lucas FARRONI](https://github.com/lucasfarroni)  
[Clément PERRIN](https://github.com/Alfiov)  

# Installer Docker et composer

1. Démarrer le service Docker

```
docker-compose up
```

2. Ouvrir un terminal dans le container php

```
docker-compose exec --workdir /app php /bin/bash
```

3. Installer les dépendances avec composer

```
composer update
```

4. Installer les dépances PDO

```
docker-php-ext-install mysqli pdo pdo_mysql
```

5. Le serveur web est accessible sur le port 8080

