# 🌱 Digital Garden

Application web minimaliste permettant à chaque utilisateur d’organiser ses idées à travers des thèmes et des notes, dans un espace totalement privé appelé **Jardin Numérique**.

---

## 📌 Description du projet

Digital Garden est une application développée en **PHP procédural** avec une base de données **MySQL**, et une interface réalisée en **HTML/CSS**, **Bootstrap**, et **JavaScript**.

Elle permet :

- la création d’un compte et l’authentification sécurisée  
- la gestion complète (CRUD) des thèmes  
- la gestion complète (CRUD) des notes  
- des filtres de recherche pour faciliter l’organisation  
- une séparation stricte des données : chaque utilisateur voit uniquement son contenu  

---

## 🚀 Fonctionnalités principales

### 🔐 Authentification
- Inscription avec validation (JS + PHP)
- Connexion sécurisée
- Sessions utilisateur
- Redirection automatique si non authentifié

### 🌿 Gestion des Thèmes
- Création, modification, suppression
- Couleur personnalisée
- Tags optionnels
- Affichage du nombre de notes liées à chaque thème

### 🍃 Gestion des Notes
- Titre, contenu, importance (1–5)
- CRUD complet
- Date de création
- Filtres :
  - par thème  
  - par importance  
  - par mots-clés  

### 🛡 Sécurité
- Requêtes préparées (MySQLi)
- Protection XSS (`htmlspecialchars`)
- Contrôles des permissions (un utilisateur → ses données uniquement)
- Double validation (client + serveur)

---

## 🧱 Technologies utilisées

- PHP 8 (procédural)
- MySQL / MariaDB
- HTML5 / CSS3
- Bootstrap 5
- JavaScript (validation & interactions)
- Sessions PHP

---

## 📂 Arborescence du projet

digital-garden/
│── index.php
│── login.php
│── register.php
│── dashboard.php
│── themes.php
│── notes.php
│── logout.php
│── config/
│     └── database.php
│── includes/
│     ├── header.php
│     ├── footer.php
│     └── auth.php
│── public/
│     ├── css/
│     │    └── styles.css
│     └── js/
│          └── validation.js
└── sql/
      └── schema.sql
