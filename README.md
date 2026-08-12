# learner-tracking
Application web laravel de suivi academique
## Condition requise
Assurez-vous d'avoir installé les éléments suivants sur votre machine :
* **PHP>=8.2**
* **Composer**
* **Node.js & NPM**
* **MySQL / PostgreSQL / SQLite**

## Installation
Suivez ces étapes pour installer le projet localement :

### 1. Cloner le projet
```
bash
https://github.com/ifnti-dev/learner-tracking.git
cd learner-tracking
```
### 2. Installer les dépendances PHP
```
bash
Composer install 
```
### 3. Installer les dépendances Front-end
```
bash
npm install
```
### 4. Configurer l'environnement
Copiez le fichier d'exemple pour créer votre propre fichier .env :
```
bash
cp .env.example .env
```
 *Ouvrez le fichier `.env` et configurez vos accès à la base de données (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).*
   *Vous pouvez aussi utilisez une fichier sqlite,ajoutez (`DB_CONNECTION=sqlite`) et creez une fichier database.sqlite dans le dossier database/ (`touch database/database.sqlite`)*

### 5. Générer la clé d'application
```
bash
php artisan key:generate
```
### 6. Exécuter les migrations et les seeders
Créez les tables de la base de données et insérez les données initiales de test :

```bash
php artisan migrate --seed
```


### 7. Compiler les ressources frontend
```bash
npm run dev
```

### 8. Lancement de l'application

Démarrez le serveur de développement Laravel :
```bash
php artisan serve 
Composer run dev 
```
 L'application sera accessible sur : `http://127.0.0.1:8000`