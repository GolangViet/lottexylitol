## Requirements

- Docker

## Setup Environment

### 1. Frontend Source Code:
- Copy `.env.example` to `.env`, and then update some config in this file such as below:
  
```shell
DB_HOST=db
DB_PORT=3306
DB_DATABASE=lottexylitol
DB_USERNAME=lottexylitol
DB_PASSWORD=123456xyz
```

- The `DB_HOST` should be set to `db` instead of `localhost`
- The `DB_PORT` should be set to `3306` instead of `3376`
- These services name defined in the `docker-compose.yml` file.

- You can use configuration as below to connect db via database management tool:
    - Host: `host.docker.internal` or `localhost`
    - Port: `3376`
    - Username: `lottexylitol`
    - Password: `123456xyz`

### 2. Wordpress-Backend Source Code:
- Open file `apw/wp-config.php` then configure as below:
    - Database Name: `lottexylitol`
    - Username: `lottexylitol`
    - Password: `123456xyz`
    - Database Host: `db`

### 3. Run Docker

- Run command line as below to set up docker, before run command you need to set up docker first, you can refer from [link](https://www.docker.com/products/docker-desktop/):

```shell
# Solution 1 (Normal):
$ docker-compose build

# After it is built, we need to run this to check the processing of containers (successes, failures)
$ docker-compose up

# If all services are successes
$ docker-compose up -d
```

- Access docker container:

```shell
# Solution 1:
# Run via 'docker-compose' and specific 'app' service container in 'docker-compose.yml' to run
$ docker-compose exec app bash

# Solution 2:
# List docker container ids
$ docker ps

# The 'id' can be obtained from above
$ docker exec -it 'id' bash
```

- After doing all the above steps, you can access website with links:
  - Frontend: http://localhost:8076
  - Backend: http://localhost:8076/apw/login

## Setup Ubuntu On Windows WSL

- Default path `\\wsl.localhost\{Ubuntu version}\home\{user folder}`
- Copy `.ssh` folder in windows to default path 
- Copy `.gitconfig` file in windows to default path
- Run command line `chmod 600 ~/.ssh/id_rsa` into project folder in Ubuntu VM
- Rebuild:
    + `docker-compose build`
    + `docker-compose up -d`
