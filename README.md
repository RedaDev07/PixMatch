# 🖼️ Projet Tuteuré – PixMatch

**Plateforme de mise en relation entre clients et professionnels de l'image**

## 📌 Présentation du projet
Description : Thème WordPress personnalisé pour PixMatch, plateforme de mise en relation entre clients et professionnels de l'image
**PixMatch** est une plateforme web développée en équipe dans le cadre de notre projet tuteuré de fin d'année. L'objectif était de créer un espace simple et efficace permettant aux particuliers et aux créateurs de contenu de trouver facilement des photographes, vidéastes et professionnels de l'image, tout en offrant aux pros un outil de gestion de leur activité.

🔗 **Lien du projet en ligne :** [https://pixmatch.formationsuniversitaires.fr](https://pixmatch.formationsuniversitaires.fr)

---

## 🎯 Fonctionnalités principales

| Fonctionnalité | Description |
|----------------|-------------|
| **👥 Système d’authentification** | Deux rôles (client / professionnel) avec validation manuelle des inscriptions pros |
| **💬 Messagerie interne** | Échanges entre clients et pros, avec système de corbeille et restauration des messages |
| **❤️ Favoris** | Les clients peuvent enregistrer leurs photographes préférés |
| **📍 Filtres dynamiques** | Recherche de professionnels par ville (base de données de 41 villes françaises) |
| **🎨 Header dynamique** | Changement de couleurs (violet / jaune) selon le profil connecté |
| **👤 Pages de compte** | Tableau de bord personnalisé pour clients et pros (gestion des infos, compétences) |
| **🔍 Moteur de recherche** | Barre de recherche avec page de résultats personnalisée |

---

## 🛠️ Stack technique

| Catégorie | Technologies |
|-----------|--------------|
| **CMS** | WordPress (thème 100% personnalisé) |
| **Backend** | PHP, SQL |
| **Frontend** | HTML5, CSS3, JavaScript (jQuery), AJAX |
| **Base de données** | MySQL |
| **Extensions WordPress** | Ultimate Member, Code Snippets, Pods Framework |
| **Outils** | Visual Studio Code, FileZilla, Git |

---

## 👨‍💻 Mon rôle dans le projet

- Développement complet du thème WordPress sur mesure  
- Gestion des fonctionnalités backend (PHP, SQL) et des interactions AJAX  
- Intégration des maquettes Figma en HTML/CSS  
- Mise en place de la messagerie, des favoris et des filtres dynamiques  
- Gestion des sessions, des redirections selon les rôles et du système d’approbation des professionnels

---

## 🚀 Installation et configuration

### Prérequis

- Un serveur local (XAMPP, WAMP, MAMP) ou un hébergement web
- WordPress 6.0 ou supérieur
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur

### 1. Installer WordPress

1. Téléchargez WordPress depuis [wordpress.org](https://wordpress.org/download/)
2. Décompressez l'archive dans votre dossier serveur (ex: `htdocs/pixmatch/` pour XAMPP)
3. Accédez à `http://localhost/pixmatch` et suivez l'assistant d'installation

### 2. Installer le thème PixMatch

1. **Via FTP (FileZilla)** :
   - Connectez-vous à votre serveur
   - Copiez le dossier `pixmatch-template` dans `/wp-content/themes/`
   - Activez le thème depuis l'administration WordPress

2. **Via l'administration WordPress** :
   - Compressez le dossier `pixmatch-template` en ZIP
   - Allez dans **Apparence → Thèmes → Ajouter**
   - Téléchargez le fichier ZIP et activez-le

### 3. Installer les extensions nécessaires

Dans **Extensions → Ajouter**, installez et activez :

| Extension | Rôle |
|-----------|------|
| **Ultimate Member** | Gestion des utilisateurs, rôles et inscriptions |
| **Code Snippets** | Ajout de code PHP/JS personnalisé |
| **Pods Framework** | Gestion des données des photographes (fiches, portfolios) |

### 4. Configurer Ultimate Member

1. **Créer les rôles** (Ultimate Member → Rôles des comptes) :
   - `um_client` pour les clients
   - `um_professionnel` pour les professionnels

2. **Créer les formulaires** (Ultimate Member → Formulaires) :
   - Inscription client (ID: 563)
   - Inscription professionnel (ID: 560)
   - Connexion (ID: 1769)

3. **Configurer les pages** (Ultimate Member → Réglages → Pages) :
   - Page d'accueil : `accueil-particuliers`
   - Page de connexion : `connexion`
   - Page d'inscription : `choix-inscription`

### 5. Créer les pages WordPress

| Page | Template | Slug |
|------|----------|------|
| Accueil Particuliers | PixMatch - Accueil Particuliers | `/` |
| Accueil Créateurs | PixMatch - Accueil Créateurs | `/cdc-bienvenue-sur-pixmatch` |
| Connexion | PixMatch - Connexion | `/connexion` |
| Choix Inscription | PixMatch - Choix Inscription | `/choix-inscription` |
| Inscription Client | PixMatch - Inscription Client | `/inscription-client` |
| Inscription Pro | PixMatch - Inscription Professionnel | `/inscription-professionnel` |
| Mon Compte Client | Compte Client | `/mon-compte-client` |
| Mon Compte Pro | Compte Professionnel | `/mon-compte-pro` |
| Compte en attente | (aucun) | `/compte-en-attente` |

### 6. Importer la base de données

**Pour les villes françaises :**
1. Accédez à phpMyAdmin
2. Sélectionnez votre base de données WordPress
3. Exécutez la requête SQL suivante pour créer la table (si non existante) :

```sql
CREATE TABLE IF NOT EXISTS wp_messages (
    id int(11) NOT NULL AUTO_INCREMENT,
    sender_id int(11) NOT NULL,
    receiver_id int(11) NOT NULL,
    message text NOT NULL,
    date datetime NOT NULL,
    deleted tinyint(1) DEFAULT 0,
    PRIMARY KEY (id)
);

