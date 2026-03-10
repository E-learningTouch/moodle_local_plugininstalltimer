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

$string['pluginname'] = 'Suivi des installations';
$string['installdate'] = 'Installé le';
$string['updatedate'] = 'Mise à jour';
$string['installedby'] = 'Par';
$string['unknown'] = 'Système';
$string['plugininstalltimer:view'] = 'Voir les dates';

// RGPD
$string['privacy:metadata:tabledescription'] = 'Stocke les dates des plugins.';
$string['privacy:metadata:pluginname'] = 'Nom du plugin';
$string['privacy:metadata:timeinstalled'] = 'Date installation';
$string['privacy:metadata:timemodified'] = 'Date modification';
$string['privacy:metadata:userid'] = 'ID installateur';