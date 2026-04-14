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

namespace local_plugininstalltimer;

defined('MOODLE_INTERNAL') || die();

class callbacks {
    public static function inject_js(\core\hook\output\before_footer_html_generation $hook): void {
        global $PAGE, $DB;

        $dbman = $DB->get_manager();
        if (!$dbman->table_exists('local_plugininstalltimer')) {
            return;
        }

        if ($PAGE->url->compare(new \moodle_url('/admin/plugins.php'), URL_MATCH_BASE)) {
            
            self::sync_plugins();

            $sql = "SELECT p.*, u.firstname, u.lastname, u.middlename, u.alternatename, u.firstnamephonetic, u.lastnamephonetic
                    FROM {local_plugininstalltimer} p 
                    LEFT JOIN {user} u ON u.id = p.userid";
            
            try { $records = $DB->get_records_sql($sql); } catch (\Exception $e) { return; }
            
            $pluginman = \core_plugin_manager::instance();
            $data = [];
            foreach ($records as $record) {
                $fullname = (!empty($record->firstname)) ? fullname($record) : get_string('unknown', 'local_plugininstalltimer');
                $plugininfo = $pluginman->get_plugin_info($record->pluginname);
                
                $data[] = [
                    'n' => (string)$record->pluginname,
                    'di' => userdate($record->timeinstalled, get_string('strftimedatetimeshort', 'langconfig')),
                    'dm' => userdate($record->timemodified, get_string('strftimedatetimeshort', 'langconfig')),
                    'u' => $fullname,
                    'si' => (int)$record->timeinstalled,
                    'sm' => (int)$record->timemodified,
                    'up' => ($plugininfo && !empty($plugininfo->available_updates())) ? 1 : 0,
                    'add' => ($plugininfo && !$plugininfo->is_standard()) ? 1 : 0
                ];
            }

            $jsdata = json_encode(array_values($data));
            
            // On prépare toutes les traductions pour le JavaScript
            $langstrs = [
                'filter_updates' => get_string('filter_updates', 'local_plugininstalltimer'),
                'filter_all' => get_string('filter_all', 'local_plugininstalltimer'),
                'export_add_csv' => get_string('export_add_csv', 'local_plugininstalltimer'),
                'export_maj_csv' => get_string('export_maj_csv', 'local_plugininstalltimer'),
                'alert_no_add' => get_string('alert_no_add', 'local_plugininstalltimer'),
                'alert_no_maj' => get_string('alert_no_maj', 'local_plugininstalltimer'),
                'yes' => get_string('yes', 'local_plugininstalltimer'),
                'no' => get_string('no', 'local_plugininstalltimer'),
                'csv_plugin' => get_string('csv_plugin', 'local_plugininstalltimer'),
                'installdate' => get_string('installdate', 'local_plugininstalltimer'),
                'updatedate' => get_string('updatedate', 'local_plugininstalltimer'),
                'installedby' => get_string('installedby', 'local_plugininstalltimer'),
                'updateavailable' => get_string('updateavailable', 'local_plugininstalltimer'),
            ];
            $jslang = json_encode($langstrs);
            
            $script = "
            require(['jquery', 'core/templates'], function($, Templates) {
                var d = {$jsdata};
                var lang = {$jslang}; // Récupération des traductions dynamiques
                
                var run = function() {
                    var t = $('.admintable, #plugins-control-panel').last();
                    if (!t.length || t.hasClass('plugin-timer-loaded')) return;
                    t.addClass('plugin-timer-loaded');

                    var btnContainer = $('<div class=\"mb-3 d-flex\" style=\"gap:10px; flex-wrap: wrap;\"></div>');
                    var btnFilter = $('<button class=\"btn btn-primary\">' + lang.filter_updates + '</button>');
                    var btnCsvAll = $('<button class=\"btn btn-secondary\">' + lang.export_add_csv + '</button>');
                    var btnCsvUpdates = $('<button class=\"btn btn-warning\">' + lang.export_maj_csv + '</button>');
                    
                    btnContainer.append(btnFilter).append(btnCsvAll).append(btnCsvUpdates);
                    t.before(btnContainer);

                    btnFilter.on('click', function(e) {
                        e.preventDefault();
                        var active = $(this).data('active');
                        if (active) {
                            t.find('tbody tr').show();
                            $(this).text(lang.filter_updates).removeClass('btn-warning').addClass('btn-primary').data('active', false);
                        } else {
                            t.find('tbody tr').each(function() {
                                if ($(this).find('.c-up').data('v') !== 1) { $(this).hide(); }
                            });
                            $(this).text(lang.filter_all).removeClass('btn-primary').addClass('btn-warning').data('active', true);
                        }
                    });

                    var exportToCsv = function(dataToExport, filename) {
                        var BOM = '\\uFEFF';
                        // Génération dynamique des en-têtes CSV avec les langues
                        var csv = BOM + lang.csv_plugin + ';' + lang.installdate + ';' + lang.updatedate + ';' + lang.installedby + ';' + lang.updateavailable + '\\n';
                        
                        dataToExport.forEach(function(row) {
                            var upd = row.up === 1 ? lang.yes : lang.no;
                            var cleanName = row.n.replace(/;/g, ',');
                            var cleanUser = row.u.replace(/;/g, ',');
                            csv += '\"' + cleanName + '\";\"' + row.di + '\";\"' + row.dm + '\";\"' + cleanUser + '\";\"' + upd + '\"\\n';
                        });
                        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                        var link = document.createElement('a');
                        link.href = URL.createObjectURL(blob);
                        link.download = filename + '_' + new Date().toISOString().slice(0,10) + '.csv';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    };

                    btnCsvAll.on('click', function(e) {
                        e.preventDefault();
                        var filteredData = d.filter(function(item) { return item.add === 1; });
                        if (filteredData.length === 0) {
                            alert(lang.alert_no_add);
                            return;
                        }
                        exportToCsv(filteredData, 'plugins_additionnels');
                    });

                    btnCsvUpdates.on('click', function(e) {
                        e.preventDefault();
                        var filteredData = d.filter(function(item) { return item.up === 1 && item.add === 1; });
                        if (filteredData.length === 0) {
                            alert(lang.alert_no_maj);
                            return;
                        }
                        exportToCsv(filteredData, 'maj_plugins_additionnels');
                    });

                    Templates.render('local_plugininstalltimer/columns', { isheader: true }).then(function(html) {
                        t.find('thead tr').append(html);
                        t.find('.js-timer-header').on('click', function() {
                            var type = $(this).data('type'), tbody = t.find('tbody'), rows = tbody.find('tr').get();
                            var asc = $(this).toggleClass('asc').hasClass('asc');
                            rows.sort(function(a, b) {
                                var vA = $(a).find('.c-'+type).data('v') || 0, vB = $(b).find('.c-'+type).data('v') || 0;
                                return asc ? (vA - vB) : (vB - vA);
                            });
                            $.each(rows, function(i, r) { tbody.append(r); });
                            $(this).siblings().removeClass('asc').find('i').attr('class', 'fa fa-sort');
                            $(this).find('i').attr('class', asc ? 'fa fa-sort-asc' : 'fa fa-sort-desc');
                        });
                    });

                    t.find('tbody tr').each(function() {
                        var r = $(this), txt = r.text();
                        var m = d.find(item => txt.indexOf(item.n) !== -1);
                        if (m && r.find('.pluginupdateinfo').length > 0) { m.up = 1; }
                        
                        if (!r.find('.c-si').length) {
                            var context = { iscell: true };
                            if (m) {
                                context.found = true;
                                context.si = m.si; context.di = m.di;
                                context.sm = m.sm; context.dm = m.dm;
                                context.u = m.u;
                                context.hasupdate = (m.up === 1);
                                context.sortup = m.up;
                            } else { context.found = false; }
                            Templates.render('local_plugininstalltimer/columns', context).then(function(html) { r.append(html); });
                        }
                    });
                };
                run(); setTimeout(run, 2000);
            });";
            
            $PAGE->requires->js_amd_inline($script);
        }
    }

    private static function sync_plugins(): void {
        global $DB, $USER;
        $pluginman = \core_plugin_manager::instance();
        foreach ($pluginman->get_plugins() as $type => $list) {
            foreach ($list as $name => $plugininfo) {
                $comp = $type . '_' . $name;
                $path = $plugininfo->rootdir;
                $mtime = ($path && file_exists($path)) ? filemtime($path) : time();
                $ctime = ($path && file_exists($path)) ? filectime($path) : time();
                $fdate = max($mtime, $ctime); 
                $log_data = self::get_real_installer_data($comp);
                if ($rec = $DB->get_record('local_plugininstalltimer', ['pluginname' => $comp])) {
                    $updated = false;
                    if ($log_data && $log_data->time > $rec->timemodified) {
                        $rec->timemodified = $log_data->time;
                        $rec->userid = $log_data->userid;
                        $updated = true;
                    } 
                    else if ($fdate > $rec->timemodified) {
                        $rec->timemodified = $fdate;
                        $rec->userid = ($fdate > (time() - 86400)) ? $USER->id : 0;
                        $updated = true;
                    }
                    if ($rec->userid == 0 && $log_data && $log_data->userid != 0) {
                        $rec->userid = $log_data->userid; $updated = true;
                    }
                    if ($updated) { $DB->update_record('local_plugininstalltimer', $rec); }
                } else {
                    $time = ($log_data) ? $log_data->time : $fdate;
                    $userid = ($log_data && $log_data->userid != 0) ? $log_data->userid : (($fdate > (time() - 86400)) ? $USER->id : 0);
                    $new = (object)['pluginname' => $comp, 'timeinstalled' => $time, 'timemodified' => $time, 'userid' => $userid];
                    $DB->insert_record('local_plugininstalltimer', $new);
                }
            }
        }
    }

    private static function get_real_installer_data(string $pluginname): ?object {
        global $DB;
        try {
            $sql = "SELECT userid, timemodified FROM {upgrade_log} WHERE plugin = ? ORDER BY timemodified DESC";
            $logs = $DB->get_records_sql($sql, [$pluginname], 0, 1);
            if (!empty($logs)) { $log = reset($logs); return (object)['userid' => (int)$log->userid, 'time' => (int)$log->timemodified]; }
        } catch (\Exception $e) {} 
        try {
            $sql = "SELECT userid, timemodified FROM {config_log} WHERE plugin = ? AND name = 'version' ORDER BY timemodified DESC";
            $logs = $DB->get_records_sql($sql, [$pluginname], 0, 1);
            if (!empty($logs)) { $log = reset($logs); return (object)['userid' => (int)$log->userid, 'time' => (int)$log->timemodified]; }
        } catch (\Exception $e) {}
        return null;
    }
}
