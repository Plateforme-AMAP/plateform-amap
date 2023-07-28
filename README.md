
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

## Ux part
Site maps

<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/de4a716e-8711-432d-87eb-4a76dde727bc" alt="front office sitemap" width="900"/>
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/f0e1f009-b003-4044-aa2f-a1e19306f22b" alt="back office sitemap" width="900"/>

Wireframes

<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/39a6850b-d018-44ac-ae0e-68de01eeea5f" alt="front office wireframes" width="900"/>
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/030a2b22-cd5c-4799-87c5-c269d28a0174" alt="front office wireframes" width="900"/>
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/b9da2b21-4b67-4e9c-86f4-8e247d137dab" alt="front office wireframes" width="900"/>


<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/97c0b2c1-e37e-4732-b183-9198fd44b7cd" alt="backoffice wireframes" width="900"/>

## Styleguide and ATOMIC Design

All components (exemple of cut)
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/65b001ca-f363-46c5-96d4-8bb756fe1aab" alt="drawing" width="900"/>

Details

<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/8ce774da-b1b2-4d8b-8150-9c9f883ba6bf" alt="atoms" width="300"/>
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/5638a567-d216-47f8-a6b6-591b2e57c4de" alt="moleculs" width="300"/>
<img src="https://github.com/Plateforme-AMAP/plateform-amap/assets/87066549/9f0bff8b-2fad-4211-8f1c-d25c5d2a354b" alt="organisms" width="300"/>



![Find the complete project here ! (french version only - english version on progress)](https://docs.google.com/document/d/1dUAbSsfGOnTWpVyxHnKU8P-3eCXqlNNdPv_MxDIVFBY/edit?usp=sharing)


