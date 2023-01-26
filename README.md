## The project : "HO-Plateform"
Project to create turnkey sites for farmers' associations (AMAPs)

## Installation

>the project works with Symfony

To install PHP, if you haven't
[ubuntu]  
```bash
sudo apt upgrade 
```
```bash
sudo apt install php8.1 
```

[The DigitalOcean documentation](https://www.digitalocean.com/community/tutorials/how-to-install-php-8-1-and-set-up-a-local-development-environment-on-ubuntu-22-04)

## Run Locally

Clone the project

```bash
  git clone https://github.com/Plateforme-AMAP/plateform-amap.git
```

Go to the project directory

```bash
  cd plateform-amap
```

Configure .env

```bash
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/ho-plateform?serverVersion=5.7&charset=utf8mb4"
```

Install dependencies

```bash
  composer install
```

Start the server

```bash
  symfony server:start
```
