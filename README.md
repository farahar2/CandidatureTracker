# CandidatureTracker

Application web de suivi de candidatures d'emploi développée avec Laravel 13.

## Fonctionnalités

- Inscription, connexion et déconnexion
- Créer, modifier et archiver des candidatures
- Filtrer les candidatures par statut et priorité
- Ajouter, modifier et supprimer des entretiens
- Page d'archives avec restauration
- Protection des données par utilisateur (Policy)
- Interface responsive (mobile, tablette, desktop)
- Design sombre/clair avec Tailwind CSS

## Stack technique

| Technologie         | Rôle                     |
|---------------------|--------------------------|
| Laravel 13          | Framework PHP (MVC)      |
| MySQL 8.0+          | Base de données          |
| Blade               | Moteur de templates      |
| Tailwind CSS v3     | Framework CSS utilitaire |
| Alpine.js v3        | Interactivité JavaScript |
| Lucide              | Icônes SVG               |
| Vite                | Bundler frontend         |

## Prérequis

- PHP 8.3+
- Composer
- MySQL 8.0+
- Node.js 18+ et npm
- Git

## Installation

```bash
git clone https://github.com/ton-username/candidature-tracker.git
cd candidature-tracker
```

### Installer les dépendances PHP

```bash
composer install
```

### Installer les dépendances JavaScript

```bash
npm install
```

### Configuration de l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

Configurez les informations de base de données dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=candidature_tracker
DB_USERNAME=root
DB_PASSWORD=
```

### Exécuter les migrations

```bash
php artisan migrate
```

### Compiler les assets frontend

```bash
npm run build
```

### Lancer le serveur

```bash
php artisan serve
```

Accédez à l'application sur [http://localhost:8000](http://localhost:8000).

## Développement

Pour compiler les assets en mode développement avec rechargement à chaud :

```bash
npm run dev
```

## Structure du projet

```
resources/
├── css/
│   └── app.css              # Styles Tailwind + design system
├── js/
│   └── app.js               # Alpine.js + Lucide icons
└── views/
    ├── applications/         # CRUD candidatures
    ├── interviews/           # CRUD entretiens
    ├── auth/                 # Connexion, inscription, mdp
    ├── components/           # Composants Blade partagés
    ├── layouts/              # Layouts (app, guest)
    ├── profile/              # Gestion du profil
    ├── dashboard.blade.php   # Tableau de bord
    └── welcome.blade.php     # Page d'accueil
```