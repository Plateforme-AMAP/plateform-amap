# HO-Plateform | Projet for farmers' associations (AMAPs)

![image](https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/2c25139d-7e7e-48d8-b7e4-3019c805dbc1)


## Based on a formation project 
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

## Technologies

- SYMFONY (PHP Framework)
- with TWIG/SASS
- mySQL
- PHPmyadmin
- Mailtrap for local email testing

## Methods

- ABEM for namming
- ATOMIC design
[Official documentation of atomic design](https://bradfrost.com/blog/post/atomic-web-design/)

(for design, folders organisation)

Application of Atomic design inside the project :

<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/b7ecdaf2-a391-4cba-adf0-a8adae72a0bd" width="60%">
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/2d569fcd-d30d-4786-96f1-33bb7517d3ff" width="30%">



<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/9078d931-8c8a-4d6e-91eb-bbc5ba0de344" width="30%">
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/8c358011-8031-413d-8393-3ed09ec6acf4" width="30%">
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/05dade77-5399-4672-99cd-ddd2746063cc" width="30%">

## Conception ~ design
(for more information the access of the complete folder <a href="https://docs.google.com/document/d/1dUAbSsfGOnTWpVyxHnKU8P-3eCXqlNNdPv_MxDIVFBY/edit?usp=sharing">HERE</a> (french version only - english version on progress))
>the entiere conception of the website was realized 50% on Adobe XD and 50% on Figma in a learning purpose


https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/62a69b7f-b31a-4efa-bf6a-7a00c675fe54

Details of the interaction for UX testing :

![maquettes1](https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/2506b966-5f6e-493c-9f1d-ea980f89b7a9)

Back office part :
![image](https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/8a562469-7504-4bf6-9e61-e89158d7e295)


## :floppy_disk: Curious ? have a look at the project folder

<a href="https://docs.google.com/document/d/1dUAbSsfGOnTWpVyxHnKU8P-3eCXqlNNdPv_MxDIVFBY/edit?usp=sharing">Find the complete project here ! (french version only - english version on progress)</a>

## Team for the V.0

[Mathilde](https://github.com/Evlow) : UI/UI DESIGN / full stack development

[Kevin](https://github.com/KevinLANGLET) :  Marketing / front-end development

[Lise](https://github.com/LiseRochat) : Specifications / full stack development / project organization

[Julie :)](https://github.com/julieprunaret/) : UI/UI DESIGN / full stack development / project organization


## Team for the V.1 (

[Julie :)](https://github.com/julieprunaret/) : UI/UI DESIGN / full stack development / project organization

[Lise](https://github.com/LiseRochat) :  Marketing / Specifications / project organization

Special thanks to [Mathilde](https://github.com/Evlow) and [Kevin](https://github.com/KevinLANGLET)

