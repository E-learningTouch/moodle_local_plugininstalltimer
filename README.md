# Moodle Plugin Install Timer (local_plugininstalltimer)

![Moodle Version](https://img.shields.io/badge/Moodle-4.5%2B-orange)
![License](https://img.shields.io/badge/license-GPLv3-blue)
![Status](https://img.shields.io/badge/status-Stable-green)

## 🇬🇧 English Description

**Plugin Install Timer** is a local plugin for Moodle that adds tracking information to the Plugins Overview page (`/admin/plugins.php`).

By default, Moodle does not display when a plugin was installed or updated. This plugin solves this by adding three sortable columns to the administration table:

1.  **Installed on:** The date the plugin was first detected by this tool.
2.  **Last update:** The date the plugin files were last modified on the server.
3.  **By:** The name of the administrator who installed or updated the plugin.

### Features
* **Automatic Scanning:** Detects new plugins and file changes automatically when visiting the plugins overview page.
* **User Tracking:** Records the User ID of the person who triggered the installation or update.
* **Sortable Columns:** You can sort plugins by installation date to easily see what changed recently.
* **GDPR Compliant:** Includes Privacy API implementation.
* **Update Detection:** New column indicating if a plugin has an update available.
* **CSV Export:** Buttons to generate Excel-compatible CSV reports.
* **Quick Filter**

### Installation
1.  Download the `.zip` file.
2.  Go to **Site administration > Plugins > Install plugins**.
3.  Upload the ZIP file and install.
4.  Go to **Site administration > Plugins > Plugins overview** to populate the data.

> **Note:** Upon first installation, the "Installed on" date will be set to the current timestamp for all existing plugins, and the "By" user will be the current administrator. Future installations and updates will be tracked accurately.

---

## 🇫🇷 Description en Français

**Suivi des installations de plugins** est un plugin local pour Moodle qui ajoute des informations de traçabilité sur la page "Vue d'ensemble des plugins" (`/admin/plugins.php`).

Par défaut, Moodle n'affiche pas quand un plugin a été installé. Ce plugin corrige cela en injectant trois colonnes triables dans le tableau d'administration :

1.  **Installé le :** La date de première détection du plugin.
2.  **Mise à jour :** La date de dernière modification des fichiers sur le serveur.
3.  **Par :** Le nom de l'administrateur ayant effectué l'installation ou la mise à jour.

### Fonctionnalités
* **Scan Automatique :** Détecte les nouveaux plugins et les modifications de fichiers dès que vous visitez la page des plugins.
* **Suivi Utilisateur :** Enregistre l'ID de l'utilisateur qui a déclenché l'opération.
* **Tri :** Les colonnes sont triables, pratique pour voir les derniers ajouts.
* **Conformité RGPD :** Implémentation de l'API Privacy incluse.

### Installation
1.  Téléchargez le fichier `.zip`.
2.  Allez dans **Administration du site > Plugins > Installer des plugins**.
3.  Déposez le fichier ZIP et installez.
4.  Rendez-vous sur **Administration du site > Plugins > Vue d'ensemble des plugins** pour initialiser les données.

> **Note :** Lors de la première installation de ce plugin, la date "Installé le" sera réglée sur la date actuelle pour tous les plugins déjà présents, et l'utilisateur "Par" sera vous-même. Les futures installations seront suivies précisément.

---

### Technical Details / Détails Techniques
* **Database:** Creates a table `mdl_local_plugin_install_dates`.
* **Hook:** Uses `core\hook\output\before_footer_html_generation` to inject JS.
* **JS:** jQuery is used to append columns to the existing Moodle table dynamically.
