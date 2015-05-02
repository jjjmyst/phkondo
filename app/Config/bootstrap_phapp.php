<?php

//CakePlugin::load('PrintReceipt',array('bootstrap'=>true));
//CakePlugin::load('Reports',array('bootstrap'=>true));
//CakePlugin::load('Drafts',array('bootstrap'=>true));

/** Theme Settings
 * 
 */
Configure::write('Theme.owner_name', '');
Configure::write('Theme.owner_title', 'Administração ao cuidado de XXXXXX');
Configure::write('Theme.owner_address', 'Avenida XX de XXXXX NXX Loja A XXXX-XXX XXXXX , Telef: XXXXXXXXX / XXXXXXXXX');
Configure::write('Theme.base_color', '#428bca');

/**
 * Default app settings
 */

/**
 * Languages available
 */
Configure::write('Config.language', 'por'); 
Configure::write('Language.list',array(
    'eng'=>'English',
    'por'=>'Português',
   
    )); 
Configure::write('Config.language', 'eng'); // por - Portuguese , eng - english .....
Configure::write('Language.list',array('eng'=>'English','por'=>'Portugues')); // 
Configure::write('Config.timezone', 'Europe/Lisbon'); // Europe/Lisbon
Configure::write('databaseDateFormat', 'Y-m-d'); // database dateformat
Configure::write('dateFormat', 'd-m-Y H:i:s'); // phkondo dateformat with time
Configure::write('dateFormatSimple', 'd-m-Y'); // phkondo dateformat
Configure::write('calendarDateFormat', 'dd-mm-yyyy'); // input date fields date format
Configure::write('currencySign', '&euro;'); // more at http://www.w3schools.com/html/html_entities.asp
Configure::write('Application.mode', 'app'); // phkapa , demo , use demo for demo mode;

/**
 * The settings for maintenance component 
 */
Configure::write('MaintenanceMode.start', '01-01-2000 00:00:00'); 
Configure::write('MaintenanceMode.duration', '48'); // Duration in hours
Configure::write('MaintenanceMode.site_offline_url', '/pages/offline');

/**
 * The settings below can be used to open access to pHKondo.
 * - set to true / false
 * - true will open pHKondo to all access. 
 */
Configure::write('Access.open', false); // For SECURITY keep this FALSE , use only on emergency.

/**
 * User role settings , do not change unless you know what you are doing 
 */
Configure::write('User.role',array('admin' => __('App Administrator'),'store_admin' => __n('Manager','Managers',1),'colaborator' => __('Employee')));
