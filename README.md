<base target="_blank"> 
# HO-Plateform | Projet for farmers' associations (AMAPs)

## based on a formation project 
Project to create turnkey sites for farmers' associations (AMAPs)
Training project that has mutated into a major project for the AMAP AURA association. Discover the latest version of this project created from scratch, from the idea to the final development, including marketing and design.

## Installation

>the project works with SYMPHONY (PHP framework)

To install PHP, if you haven't
[The official documentation](https://www.php.net/downloads)
  

- [ ]  Install [PHP](https://www.php.net/downloads)
- [ ]  Install [Symfony CLI](https://symfony.com/download)  :
```bash
  scoop install symfony-cli
```
- [ ]  Install [Composer](https://getcomposer.org/download/)  :

[ubuntu]  
```bash
sudo apt upgrade 
```
```bash
sudo apt install php8.1 
```
[The DigitalOcean documentation PHP on ubuntu](https://www.digitalocean.com/community/tutorials/how-to-install-php-8-1-and-set-up-a-local-development-environment-on-ubuntu-22-04)

```bash
npm install --global yarn
```
[The Official documentation YARN](https://classic.yarnpkg.com/lang/en/docs/install/#windows-stable)

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

Create and migrate database

```bash
  symfony console doctrine:database:create
```
```bash
  symfony console make:migration
```
```bash
  symfony console doctrine:migrations:migrate
```

build with Webpack encore 
```bash
  yarn
```
```bash
  yarn build
```
```bash
  yarn watch
```

[The Official documentation](https://symfony.com/doc/current/frontend/encore/simple-example.html)


Start the server

```bash
  symfony server:start
```

## Help !

in case of troubles you can run :

```bash
  composer update
```
and

```bash
  composer recipe
```

still have troubles you can run :
```bash
  yarn
```
you can delete all migrations before creating the base

## :floppy_disk: Curious ? the project folder

<a href="https://docs.google.com/document/d/1dUAbSsfGOnTWpVyxHnKU8P-3eCXqlNNdPv_MxDIVFBY/edit?usp=sharing">Find the complete project here ! (french version only - english version on progress)</a>

