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

function xmldb_local_plugininstalltimer_upgrade($oldversion) {
    global $DB;
    $dbman = $DB->get_manager();

    if ($oldversion < 2026100500) {
        // 1. Ajouter le champ version à la table principale
        $table = new xmldb_table('local_plugininstalltimer');
        $field = new xmldb_field('version', XMLDB_TYPE_CHAR, '30', null, null, null, null, 'pluginname');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // 2. Créer la nouvelle table d'historique
        $histtable = new xmldb_table('local_plugininstalltimer_hist');
        $histtable->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $histtable->add_field('pluginname', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $histtable->add_field('version', XMLDB_TYPE_CHAR, '30', null, null, null, null);
        $histtable->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, 0);
        $histtable->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        
        $histtable->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if (!$dbman->table_exists($histtable)) {
            $dbman->create_table($histtable);
        }

        upgrade_plugin_savepoint(true, 2026100500, 'local', 'plugininstalltimer');
    }
    return true;
}