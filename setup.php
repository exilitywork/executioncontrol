<?php

define('PLUGIN_EXECUTIONCONTROL_MIN_GLPI_VERSION', '9.4');
define('PLUGIN_EXECUTIONCONTROL_NAMESPACE', 'executioncontrol');

/*if (!defined("PLUGINFIELDSUPGRADE_DIR")) {
    define("PLUGINFIELDSUPGRADE_DIR", GLPI_ROOT . "/plugins/fieldsupgrade");
 }
 
 if (!defined("PLUGINFIELDSUPGRADE_DOC_DIR")) {
    define("PLUGINFIELDSUPGRADE_DOC_DIR", GLPI_PLUGIN_DOC_DIR . "/fieldsupgrade");
 }
 if (!file_exists(PLUGINFIELDSUPGRADE_DOC_DIR)) {
    mkdir(PLUGINFIELDSUPGRADE_DOC_DIR);
 }

if (!defined("PLUGINFIELDSUPGRADE_CLASS_PATH")) {
    define("PLUGINFIELDSUPGRADE_CLASS_PATH", PLUGINFIELDSUPGRADE_DOC_DIR . "/inc");
 }
 if (!file_exists(PLUGINFIELDSUPGRADE_CLASS_PATH)) {
    mkdir(PLUGINFIELDSUPGRADE_CLASS_PATH);
 }
 
 if (!defined("PLUGINFIELDSUPGRADE_FRONT_PATH")) {
    define("PLUGINFIELDSUPGRADE_FRONT_PATH", PLUGINFIELDSUPGRADE_DOC_DIR."/front");
 }
 if (!file_exists(PLUGINFIELDSUPGRADE_FRONT_PATH)) {
    mkdir(PLUGINFIELDSUPGRADE_FRONT_PATH);
 }*/

/**
 * Plugin description
 *
 * @return boolean
 */
function plugin_version_executioncontrol() {
    return [
      'name' => 'Ticket Execution Control',
      'version' => '1.0',
      'author' => 'BELWEST - Kapeshko Oleg',
      'homepage' => '',
      'license' => 'local',
      'minGlpiVersion' => PLUGIN_EXECUTIONCONTROL_MIN_GLPI_VERSION,
    ];
}

/**
 * Initialize plugin
 *
 * @return boolean
 */
function plugin_init_executioncontrol() {
    if (Session::getLoginUserID()) {
        global $PLUGIN_HOOKS;
        $PLUGIN_HOOKS['csrf_compliant'][PLUGIN_EXECUTIONCONTROL_NAMESPACE] = true;
        // add tabs to itemtypes
        Plugin::registerClass('PluginExecutioncontrolProfile', ['addtabon' => 'Profile']);
        if (Session::haveRight('plugin_executioncontrol_tab', READ)) {
            Plugin::registerClass('PluginExecutioncontrolField', ['addtabon' => 'Ticket']);
        }
        $PLUGIN_HOOKS['post_show_tab'][PLUGIN_EXECUTIONCONTROL_NAMESPACE] = ['PluginExecutioncontrolField', 'post_show_tab'];
        //$PLUGIN_HOOKS['pre_item_form'][PLUGIN_EXECUTIONCONTROL_NAMESPACE] = ['Pluginexecutioncontrolexecutioncontrol, 'pre_item_form'];
    }
}

/**
 * Check if plugin prerequisites are met
 *
 * @return boolean
 */
function plugin_executioncontrol_check_prerequisites() {
    $prerequisites_check_ok = false;

    try {
        if (version_compare(GLPI_VERSION, PLUGIN_EXECUTIONCONTROL_MIN_GLPI_VERSION, '<')) {
            throw new Exception('This plugin requires GLPI >= ' . PLUGIN_EXECUTIONCONTROL_MIN_GLPI_VERSION);
        }

        $prerequisites_check_ok = true;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

    return $prerequisites_check_ok;
}

/**
 * Check if config is compatible with plugin
 *
 * @return boolean
 */
function plugin_executioncontrol_check_config() {
    // nothing to do
    return true;
}
