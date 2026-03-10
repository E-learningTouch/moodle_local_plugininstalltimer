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
namespace local_plugininstalltimer\privacy;
defined('MOODLE_INTERNAL') || die();

class provider implements \core_privacy\local\metadata\provider, \core_privacy\local\request\plugin\provider {
    public static function get_metadata(\core_privacy\local\metadata\collection $collection) : \core_privacy\local\metadata\collection {
        return $collection->add_database_table('local_plugin_install_dates', [
            'pluginname' => 'privacy:metadata:pluginname',
            'timeinstalled' => 'privacy:metadata:timeinstalled',
            'timemodified' => 'privacy:metadata:timemodified',
            'userid' => 'privacy:metadata:userid',
        ], 'privacy:metadata:tabledescription');
    }
    public static function get_contexts_for_userid(int $userid) : \core_privacy\local\request\contextlist {
        $contextlist = new \core_privacy\local\request\contextlist();
        $contextlist->add_from_sql("SELECT c.id FROM {context} c JOIN {local_plugin_install_dates} p ON p.userid = :userid WHERE c.contextlevel = :level", ['userid' => $userid, 'level' => CONTEXT_SYSTEM]);
        return $contextlist;
    }
    public static function export_user_data(\core_privacy\local\request\context_data_preference $reader) {}
    public static function delete_data_for_all_users_in_context(\context $context) {}
    public static function delete_data_for_user(\core_privacy\local\request\approved_contextlist $contextlist) {}
}