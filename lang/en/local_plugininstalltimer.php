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

$string['pluginname'] = 'Plugin Installations Monitoring';
$string['installdate'] = 'Installed on';
$string['updatedate'] = 'Last update';
$string['installedby'] = 'By';
$string['unknown'] = 'System';
$string['plugininstalltimer:view'] = 'View install dates';

$string['updateavailable'] = 'Update Available';
$string['filter_updates'] = 'Filter: Updates available';
$string['filter_all'] = 'Show all plugins';
$string['export_add_csv'] = 'Export additional plugins list (CSV)';
$string['export_maj_csv'] = 'Export additional updates list (CSV)';
$string['alert_no_add'] = 'No additional plugins found on this site.';
$string['alert_no_maj'] = 'No updates available for your additional plugins.';
$string['yes'] = 'Yes';
$string['no'] = 'No';
$string['csv_plugin'] = 'Plugin';

// GDPR
$string['privacy:metadata:tabledescription'] = 'Stores plugin dates.';
$string['privacy:metadata:pluginname'] = 'Plugin name';
$string['privacy:metadata:timeinstalled'] = 'Install date';
$string['privacy:metadata:timemodified'] = 'Update date';

$string['privacy:metadata:userid'] = 'Installer ID';
