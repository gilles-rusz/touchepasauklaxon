# 🚗 Touche Pas au Klaxon

Application intranet de covoiturage inter-sites pour une entreprise, développée en PHP avec une architecture MVC personnalisée.

---

## 📦 Technologies utilisées

- PHP (sans framework, MVC fait main)
- MySQL / MariaDB
- Bootstrap 5
- Sass (précompilé)
- Routeur PHP simple (type bramus)
- Tests prévus avec PHPUnit (abandonnés)
- Analyse statique prévue avec PHPStan (abandonnée)

---

## ⚙️ Installation

### 1. Cloner le dépôt
```bash
git clone https://github.com/votre-utilisateur/touchepasauklaxon.git
```

### 2. Configurer l'environnement
- Copier le dossier dans votre serveur local (WAMP/XAMPP)
- Importer la base de données fournie via phpMyAdmin (`touchepasauklaxon.sql`)
- Vérifier la configuration de la connexion dans `app/core/Database.php`

### 3. Arborescence du projet
```
app/
├── Controllers/
├── Model/
├── Views/
config/
routes/
public/
tests/
vendor/
```

---

## 🧪 Identifiants de connexion

| Rôle     | Email                    | Mot de passe |
|----------|--------------------------|--------------|
| Admin    | admin@entreprise.fr      | admin123     |
| Employé  | employe1@entreprise.fr   | employe123   |

> Les comptes sont configurés dans la base importée (`touchepasauklaxon.sql`)

---

## 🧱 Modèle de données

- ✔️ MCD & MLD fournis dans `/docs/`
- Entités principales : `employe`, `agence`, `trajet`

---

## 📚 Fonctionnalités livrées

- Authentification avec gestion des rôles
- Affichage public des trajets disponibles
- Espace employé avec liste + détails trajets
- Espace admin complet avec gestion agences / employés
- Création, modification et suppression des trajets (selon droits)
- Interface responsive avec Bootstrap
- Gestion dynamique du header selon utilisateur
- Flash messages

---

## ❗ Remarques

- Les tests unitaires et l'analyse statique ont été partiellement préparés mais bloqués par des restrictions système (Windows + antivirus).
- Tout le code a été testé manuellement, en local.

---

## 👤 Auteur

- gilles ruszczycki
- Étudiant.e en developpement web
