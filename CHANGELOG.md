# Changelog

All notable changes to the `local_plugininstalltimer` project will be documented in this file.

## [1.1] - 2026-04-14

### Released
- **Update Detection / Détection des MàJ :** Added a new column indicating if a plugin has an update available, utilizing Moodle's native `core_plugin_manager` and DOM verification.
- **CSV Export / Export CSV :** Added buttons to generate Excel-compatible CSV reports (UTF-8 BOM + semicolon separator). The exports automatically filter out core Moodle plugins to focus only on *additional* plugins.
- **Quick Filter / Filtre rapide :** Added a toggle button to instantly hide up-to-date plugins and focus on those requiring attention.
- **Internationalization (i18n) / Traduction :** Completely removed hardcoded strings. Full English (`en`) and French (`fr`) support implemented across PHP, JavaScript, and Mustache templates.
- **Race Condition / Doublons UI :** Implemented a synchronous CSS lock (`plugin-timer-loaded`) to prevent the Mustache template from rendering duplicate columns during asynchronous AJAX reloads.
- **Update Cache Accuracy :** Added a JavaScript fallback that scans Moodle's native `.pluginupdateinfo` DOM elements to guarantee the "Update Available" badge displays correctly, bypassing potential PHP cache delays.


## [1.0] - 2026-03-09

### Released
- Initial release.
