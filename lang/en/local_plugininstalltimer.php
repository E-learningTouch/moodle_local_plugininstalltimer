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

$string['pluginname'] = 'Plugin Installation Tracker & History';
$string['installdate'] = 'Installed on';
$string['updatedate'] = 'Last modification';
$string['installedby'] = 'By';
$string['unknown'] = 'System / Unknown';
$string['plugininstalltimer:view'] = 'View plugin installation dates';

// Versions & History (Pop-up)
$string['version'] = 'Version';
$string['history'] = 'Version history';
$string['viewhistory'] = 'View history';
$string['historyfor'] = 'Modification history for {$a}';
$string['email'] = 'Email address';
$string['no_history'] = 'No history recorded for this plugin.';

// Badges & UI
$string['updateavailable'] = 'Update Avail.';
$string['updates_count'] = '{$a} updates';
$string['yes'] = 'Yes';
$string['no'] = 'No';
$string['close'] = 'Close';
$string['totalupdates'] = 'Total number of updates';

// Filters & Export Buttons
$string['filter_updates'] = 'Filter: Updates available';
$string['filter_all'] = 'Show all plugins';
$string['export_add_csv'] = 'Export additional plugins (Latest version)';
$string['export_history_csv'] = 'Export full history (All records)';
$string['export_maj_csv'] = 'Export pending updates only';
$string['export_hist_csv'] = 'Export history';
$string['email'] = 'Email';
$string['alert_empty_hist'] = 'The history is currently empty. No data to export.';
$string['console_click_export'] = 'Click on history export. Number of entries: ';
$string['error_csv_generation'] = 'Critical error during CSV generation: ';
$string['alert_csv_error'] = 'An error occurred while creating the file. Check the console.';

// Interface Alerts
$string['alert_no_add'] = 'No additional plugins found on this site.';
$string['alert_no_maj'] = 'No updates available for your additional plugins.';

// CSV / Excel Headers
$string['csv_plugin'] = 'Plugin';
$string['csv_version'] = 'Version';
$string['csv_date'] = 'Action date';
$string['csv_user'] = 'Operator';
$string['csv_email'] = 'Email';
$string['csv_status'] = 'Update available';

// GDPR / Privacy compliance
$string['privacy:metadata:tabledescription'] = 'Stores the current installation status and latest version of each plugin.';
$string['privacy:metadata:historytabledescription'] = 'Retains the complete chronological history of all successive versions installed.';
$string['privacy:metadata:pluginname'] = 'Technical name of the plugin';
$string['privacy:metadata:version'] = 'Plugin version number at the time of action';
$string['privacy:metadata:timeinstalled'] = 'Timestamp of the very first deployment';
$string['privacy:metadata:timemodified'] = 'Timestamp of the installation or update action';
$string['privacy:metadata:userid'] = 'ID of the user who triggered the action';