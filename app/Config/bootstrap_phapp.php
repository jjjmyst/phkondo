<?php

/**
 *
 * pHKondo : pHKondo software for condominium property managers (http://phalkaline.net)
 * Copyright (c) pHAlkaline . (http://phalkaline.net)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @copyright     Copyright (c) pHAlkaline . (http://phalkaline.net)
 * @link          https://phkondo.net pHKondo Project
 * @package       app.Config
 * @since         pHKondo v 0.0.1
 * @license       http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 * 
 */
CakePlugin::load('DebugKit');
CakePlugin::load('ClearCache');
CakePlugin::load('Feedback');
CakePlugin::load('Migrations');

try {
    CakePlugin::load('Drafts', array('bootstrap' => true));
    CakePlugin::load('PrintReceipt', array('bootstrap' => true));
    CakePlugin::load('Reports', array('bootstrap' => true));
    CakePlugin::load('Drafts', array('bootstrap' => true));
    CakePlugin::load('Attachments', array('bootstrap' => true));
    Configure::write('Application.isFullPack',true);
} catch (\Exception $e) {
    Configure::write('Application.isFullPack',false);
}
/*
 * CakePdf Plugin
 * Requires PrintReceipt and Reports Plugin
 * Requires wkhtmltopdf engine at your system
 * https://wkhtmltopdf.org/ 
 */
//CakePlugin::load('CakePdf', array('bootstrap' => true, 'routes' => false));
Configure::write('CakePdf', array(
    'binary' => '/usr/local/bin/wkhtmltopdf', 
    // windows: C:\xampp7427\wkhtmltopdf\bin\wkhtmltopdf.exe
    // linux: /usr/local/bin/wkhtmltopdf
    // Requires wkhtmltopdf engine 
    // https://wkhtmltopdf.org/
    'engine' => 'CakePdf.WkHtmlToPdf',
    'orientation' => 'portrait',
    'download' => true,
    'options' => [
        'disable-javascript' => true,
        'print-media-type' => true,
        'enable-local-file-access' => true
    ],
    'phkondo' => [
        'active' => false, // Requires CakePdf Plugin 
        'cssPath' => APP . 'View' . DS . 'Themed' . DS . 'Phkondo' . DS . WEBROOT_DIR . DS . 'css' . DS,
        'imgPath' => APP . 'View' . DS . 'Themed' . DS . 'Phkondo' . DS . WEBROOT_DIR . DS . 'img' . DS,
    ]
));

Configure::write('Attachment.attachment', array(
    'path' => '{ROOT}files{DS}{model}{DS}{field}{DS}',
    'pathMethod' => 'foreignKey',
    'nameCallback' => 'fileRename',
    'thumbnails' => false,
    'thumbnailMethod' => 'php',
    'thumbnailSizes' => array(
        'xvga' => '1024x768',
        'vga' => '640x480',
        'thumb' => '80x80',
    ),
    'maxSize' => '200000',
    'extensions' => array('pdf', 'txt', 'png', 'gif', 'jpg')
));

/**
 * Theme Settings
 */
Configure::write('Theme.name', 'phkondo');
Configure::write('Theme.list', array(
    'Phkondo' => 'pHKondo',
        //'GreenAdm'=>'GreenAdm',
        //'SBAdmin'=>'SBAdmin',
));
Configure::write('Theme.owner_name', 'pHKondo');
Configure::write('Theme.owner_name_abbrv', 'PHK');
Configure::write('Theme.owner_description', 'Condominium Management');
Configure::write('Theme.owner_title', 'Administration Company Name');
Configure::write('Theme.owner_address', 'Administration Company Address , Contacts: 968258741 / admin@company.com');
Configure::write('Theme.base_color', '#428bca');

/**
 * App Settings
 */
Configure::write('Application.mode', 'free'); // free, full, one, pro, demo -> use demo for demo mode;
Configure::write('Config.timezone', 'Europe/London'); // Europe/Lisbon
Configure::write('databaseDateFormat', 'Y-m-d'); // database dateformat
Configure::write('dateFormat', 'd-m-Y H:i:s'); // phkondo dateformat with time
Configure::write('dateFormatSimple', 'd-m-Y'); // phkondo dateformat
Configure::write('calendarDateFormat', 'dd-mm-yyyy'); // input date fields date format
Configure::write('currencySign', '&euro;'); // more at http://www.w3schools.com/html/html_entities.asp

/**
 * Idiom Settings
 */
Configure::write('Language.default', 'eng');
Configure::write('Language.list', array(
    'eng' => 'English',
    'spa' => 'Español',
    'ita' => 'Italiano',
    'por' => 'Português',
    'pt-br' => 'Português ( Brasil)'
));

/**
 * Settings for maintenance component
 */
Configure::write('MaintenanceMode.start', '01-01-2000 00:00:00'); // Date 01-01-2000 00:00:00
Configure::write('MaintenanceMode.duration', ''); // Duration in hours
Configure::write('MaintenanceMode.site_offline_url', '/pages/maintenance_offline');

/**
 * Settings for Subscription component
 */
Configure::write('SubscriptionManager.start', '31-12-9999'); // Date 31-12-9999
Configure::write('SubscriptionManager.duration', '30'); // Duration in days
Configure::write('SubscriptionManager.site_offline_url', '/pages/subscription_offline');
