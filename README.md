## SymfonyPress

Mini CMS développé avec Symfony dans le cadre d’un TP noté.
Le projet propose un front public (articles, catégories) et un back-office sécurisé avec gestion des utilisateurs et des articles.

## 🛠️ Technologies utilisées

Symfony

Doctrine ORM

Twig

Composant Security

MySQL / MariaDB / PostgreSQL

Composer

## 📁 Architecture du projet
src/
├── Controller/
│   ├── Admin/
│   │   └── ArticleController.php
│   ├── ArticleController.php
│   ├── CategoryController.php
│   ├── HomeController.php
│   ├── RegistrationController.php
│   └── SecurityController.php
│
├── Entity/
│   ├── Article.php
│   ├── Category.php
│   └── User.php
│
├── Form/
│   ├── ArticleType.php
│   └── RegistrationFormType.php
│
├── Repository/
│   ├── ArticleRepository.php
│   ├── CategoryRepository.php
│   └── UserRepository.php
│
└── Security/
    └── AppAuthenticator.php


templates/
├── bundles/TwigBundle/Exception/
│   ├── error403.html.twig
│   ├── error404.html.twig
│   └── error500.html.twig
│
├── components/
│   ├── article_card.html.twig
│   └── article_preview.html.twig
│
├── layout/
│   ├── header.html.twig
│   └── footer.html.twig
│
├── pages/
│   ├── admin/article/
│   │   ├── index.html.twig
│   │   ├── new.html.twig
│   │   ├── edit.html.twig
│   │   └── _form.html.twig
│   ├── article/show.html.twig
│   ├── category/show.html.twig
│   └── home/index.html.twig
│
├── registration/register.html.twig
├── security/login.html.twig
└── base.html.twig

## ⚙️ Installation
1️⃣ Cloner le projet
git clone https://github.com/dillon816/symfony_press.git
cd symfony_press

2️⃣ Configuration de l’environnement

Créer un fichier .env à partir du fichier .env.example.

Créer ensuite un fichier .env.test :

KERNEL_CLASS='App\Kernel'
APP_SECRET='$ecretf0rt3st'


Créer ensuite un fichier .env.dev :

APP_SECRET='$h41vevv5v8ev8e4v'

🔗 Configuration de la base de données

Configurer la variable DATABASE_URL dans le fichier .env :

MySQL
DATABASE_URL="mysql://user:password@127.0.0.1:3306/symfony_press?serverVersion=8.0"

MariaDB
DATABASE_URL="mysql://user:password@127.0.0.1:3306/symfony_press?serverVersion=10.4.32-MariaDB&charset=utf8mb4"

PostgreSQL
DATABASE_URL="postgresql://user:password@127.0.0.1:5432/symfony_press?serverVersion=16&charset=utf8"

Paramètres à adapter :

user : utilisateur base de données

password : mot de passe base de données

symfony_press : nom de la base

## 3️⃣ Installer les dépendances
composer install

## 4️⃣ Initialisation de la base de données

Créer la base :

symfony console doctrine:database:create


Exécuter les migrations :

symfony console doctrine:migrations:migrate


Importer ensuite la base de données depuis le dossier BDD .

## 5️⃣ Lancer l’application

Avec Symfony CLI (recommandé) :

symfony serve:start


Ou avec PHP :

php -S 127.0.0.1:8000 -t public

## ⚠️ Problème possible

Si une erreur apparaît au lancement, vérifier le fichier :

config/packages/webpack_encore.yaml


il y a une erreur vérifier dans le dossier confi/packages/webpack_encore.yaml et remplace le
build par assets sinon tout devrais fonctionner

## 👤 Comptes utilisateurs (démo)

Mot de passe pour tous les comptes :

12345678

Name	Email
Dillon	dillon@gmail.com

Visiteur	visiteur@gmail.com

Toto	toto@gmail.com

Test42	test42@hotmail.com

Testnom	testnom@gmail.com

User1	user1@gmail.com

User2	user2@gmail.com

Didi	didi@gmail.com
## 📌 Fonctionnalités principales

Consultation des articles (front public)

Consultation par catégories

Authentification sécurisée

Back-office administrateur

Création / modification / suppression d’articles

Gestion des utilisateurs