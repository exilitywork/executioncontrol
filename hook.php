<?php

/**
 * Install the plugin
 *
 * @return boolean
 */
function plugin_executioncontrol_install() {
    global $DB;

    if (!$DB->tableExists('glpi_plugin_executioncontrol_fields')) {
        $create_table_query = "
        CREATE TABLE `glpi_plugin_executioncontrol_fields`
        (
            `id`                int(11) NOT NULL AUTO_INCREMENT,
            `user_id`           int(11) NOT NULL,
            `ticket_id`         int(11) NOT NULL,
            `devmistake`        TINYINT(1) NOT NULL DEFAULT '0',
            `exectime`          int(11) NOT NULL,
            `deadline`          TINYINT(1) NOT NULL DEFAULT '1',
            `date_mod`          datetime DEFAULT NULL,

            PRIMARY KEY (`id`)
        )
            ENGINE = InnoDB
            DEFAULT CHARSET = utf8
            COLLATE = utf8_unicode_ci;
        ";
        $DB->query($create_table_query) or die($DB->error());
    }

    return true;
}

/**
 * Uninstall the plugin
 *
 * @return boolean
 */
function plugin_executioncontrol_uninstall() {
    global $DB;

    //$drop_table_query = "DROP TABLE IF EXISTS `glpi_plugin_executioncontrol_fields`";
    //return $DB->query($drop_table_query) or die($DB->error());
    return true;
}

