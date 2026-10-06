<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version information.
 *
 * Plugin Install Timer - This plugin displays the installation and update dates of your plugins, as well as the user who made the action.
 *
 * @package     local_plugininstalltimer
 * @copyright   2026 Luiggi Sansonetti <1565841+luiggisanso@users.noreply.github.com> (Coder)
 * @copyright   2026 E-learning Touch' <contact@elearningtouch.com> (Maintainer)
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Suivi et Historique des Installations';
$string['installdate'] = 'Installé le';
$string['updatedate'] = 'Dernière modification';
$string['installedby'] = 'Par';
$string['unknown'] = 'Système / Inconnu';
$string['plugininstalltimer:view'] = 'Voir les dates d\'installation des plugins';

// Versions & Historique (Pop-up)
$string['version'] = 'Version';
$string['history'] = 'Historique des versions';
$string['viewhistory'] = 'Voir l\'historique';
$string['historyfor'] = 'Historique des modifications pour {$a}';
$string['email'] = 'Adresse courriel';
$string['no_history'] = 'Aucun historique enregistré pour ce plugin.';

// Badges et UI
$string['updateavailable'] = 'MàJ Dispo';
$string['updates_count'] = '{$a} màj';
$string['yes'] = 'Oui';
$string['no'] = 'Non';
$string['close'] = 'Fermer';
$string['totalupdates'] = 'Nombre total de mises à jour';

// Filtres et Boutons d\'export
$string['filter_updates'] = 'Filtrer : MàJ disponibles';
$string['filter_all'] = 'Afficher tous les plugins';
$string['export_add_csv'] = 'Exporter les plugins additionnels (Dernière version)';
$string['export_history_csv'] = 'Exporter l\'historique complet (Toutes les lignes)';
$string['export_maj_csv'] = 'Exporter uniquement les MàJ en attente';
$string['export_hist_csv'] = 'Exporter l\'historique';
$string['email'] = 'Courriel';
$string['alert_empty_hist'] = 'L\'historique est actuellement vide. Aucune donnée à exporter.';

// Alertes de l'interface
$string['alert_no_add'] = 'Aucun plugin additionnel trouvé sur ce site.';
$string['alert_no_maj'] = 'Aucune mise à jour disponible pour vos plugins additionnels.';
$string['console_click_export'] = 'Clic sur export Historique. Nombre d\'entrées : ';
$string['error_csv_generation'] = 'Erreur critique lors de la génération du CSV : ';
$string['alert_csv_error'] = 'Une erreur est survenue lors de la création du fichier. Consultez la console.';

// En-têtes pour les exports Excel / CSV
$string['csv_plugin'] = 'Plugin';
$string['csv_version'] = 'Version';
$string['csv_date'] = 'Date de l\'action';
$string['csv_user'] = 'Opérateur';
$string['csv_email'] = 'Email';
$string['csv_status'] = 'Mise à jour disponible';

// RGPD / Déclaration de confidentialité
$string['privacy:metadata:tabledescription'] = 'Stocke l\'état actuel et la dernière version de chaque plugin.';
$string['privacy:metadata:historytabledescription'] = 'Conserve l\'historique chronologique complet de toutes les versions successives installées.';
$string['privacy:metadata:pluginname'] = 'Nom technique du plugin';
$string['privacy:metadata:version'] = 'Numéro de version du plugin au moment de l\'action';
$string['privacy:metadata:timeinstalled'] = 'Date du tout premier déploiement';
$string['privacy:metadata:timemodified'] = 'Date de l\'installation ou de la mise à jour';
$string['privacy:metadata:userid'] = 'Identifiant de l\'utilisateur ayant déclenché l\'action';