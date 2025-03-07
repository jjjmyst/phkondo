<?php

/**
 * This is core configuration file.
 *
 * Use it to configure core behavior of Cake.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
//setLocale(LC_ALL, 'deu');
//Configure::write('Config.language', 'deu');
/**
 * CakePHP Debug Level:
 *
 * Production Mode:
 * 	0: No error messages, errors, or warnings shown. Flash messages redirect.
 *
 * Development Mode:
 * 	1: Errors and warnings shown, model caches refreshed, flash messages halted.
 * 	2: As in 1, but also with full debug messages and SQL output.
 *
 * In production mode, flash messages redirect after a time interval.
 * In development mode, you need to click the flash message to continue.
 */
Configure::write('debug',1);
Configure::write('Exception.handler', 'AppExceptionHandler::handleException');
Configure::write('Session', array('defaults' => 'php','cookie' => 'pHKondoSession'));
Configure::write('Cookie', array('name' => 'pHKondoCookie'));
/**
 * 
 */
Configure::write('installed_key', 'xyz');

/**
 * A random string used in security hashing methods.
 */
Configure::write('Security.salt', 'salt');

/**
 * A random numeric string (digits only) used to encrypt/decrypt strings.
 */
Configure::write('Security.cipherSeed', '13456');
Configure::write('Security.useOpenSsl', true);
/**
 * Uncomment this line and correct your server timezone to fix
 * any date & time related errors.
 */
date_default_timezone_set('Europe/Lisbon');


/**
 * The settings below can be used to open access to pHKondo.
 * - set to true / false
 * - true will open pHKondo to all access. 
 */
Configure::write('Access.open', false); // For SECURITY keep this FALSE , use only on emergency.

/**
 * User role settings , do not change unless you know what you are doing 
 */
Configure::write('User.role', array(
    'admin' => __('App Administrator'),
    'store_admin' => __n('Manager', 'Managers', 1),
    'colaborator' => __('Employee')
        )
);

