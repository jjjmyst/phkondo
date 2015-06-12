<?php
/**
 *
 * pHKondo : pHKondo software for condominium property managers (http://phalkaline.eu)
 * Copyright (c) pHAlkaline . (http://phalkaline.eu)
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
 * @copyright     Copyright (c) pHAlkaline . (http://phalkaline.eu)
 * @link          http://phkondo.net pHKondo Project
 * @package       app.Controller
 * @since         pHKondo v 0.0.1
 * @license       http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 * 
 */

App::uses('AppController', 'Controller');

/**
 * Maintenances Controller
 *
 * @property Maintenance $Maintenance
 * @property PaginatorComponent $Paginator
 */
class MaintenancesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Maintenance->contain('Supplier');
        $this->Paginator->settings = $this->paginate + array(
            'conditions' => array('Maintenance.condo_id' => $this->Session->read('Condo.ViewID'))
        );
        $this->setFilter(array('Maintenance.title','Maintenance.client_number', 'Supplier.name'));
        
        $this->set('maintenances', $this->paginate());
        $this->Session->delete('Condo.Maintenance');
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->Maintenance->contain('Supplier');
        if (!$this->Maintenance->exists($id)) {
            $this->Session->setFlash(__('Invalid maintenance'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        $options = array('conditions' => array('Maintenance.' . $this->Maintenance->primaryKey => $id));
        $maintenance=$this->Maintenance->find('first', $options);
        if (!count($maintenance)){
            $this->Session->setFlash(__('Invalid maintenance'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('maintenance', $maintenance);
        $this->Session->write('Condo.Maintenance.ViewID', $id);
        $this->Session->write('Condo.Maintenance.ViewName', $maintenance['Maintenance']['title']);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Maintenance->create();
            if ($this->Maintenance->save($this->request->data)) {
                $this->Session->setFlash(__('The maintenance has been saved'), 'flash/success');
                $this->redirect(array('action' => 'view',$this->Maintenance->id));
            } else {
                $this->Session->setFlash(__('The maintenance could not be saved. Please, try again.'), 'flash/error');
            }
        }
        $condos = $this->Maintenance->Condo->find('list', array('conditions' => array('id' => $this->Session->read('Condo.ViewID'))));
        $suppliers = $this->Maintenance->Supplier->find('list', array('order'=>'Supplier.name','conditions' => array('entity_type_id' => '2')));
        $this->set(compact('condos', 'suppliers'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Maintenance->exists($id)) {
            $this->Session->setFlash(__('Invalid maintenance'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Maintenance->save($this->request->data)) {
                $this->Session->setFlash(__('The maintenance has been saved'), 'flash/success');
                $this->redirect(array('action' => 'view',$id));
            } else {
                $this->Session->setFlash(__('The maintenance could not be saved. Please, try again.'), 'flash/error');
            }
        } else {
            $options = array('conditions' => array('Maintenance.' . $this->Maintenance->primaryKey => $id));
            $this->request->data = $this->Maintenance->find('first', $options);
        }
        $condos = $this->Maintenance->Condo->find('list', array('conditions' => array('id' => $this->Session->read('Condo.ViewID'))));
        $suppliers = $this->Maintenance->Supplier->find('list', array('order'=>'name','conditions' => array('entity_type_id' => '2')));
        $this->set(compact('condos', 'suppliers'));
        $this->Session->write('Condo.Maintenance.ViewID', $id);
        $this->Session->write('Condo.Maintenance.ViewName', $this->request->data['Maintenance']['title']);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @throws MethodNotAllowedException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Maintenance->id = $id;
        if (!$this->Maintenance->exists()) {
            $this->Session->setFlash(__('Invalid maintenance'), 'flash/error');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Maintenance->delete()) {
            $this->Session->setFlash(__('Maintenance deleted'), 'flash/success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Maintenance can not be deleted'), 'flash/error');
        $this->redirect(array('action' => 'view',$id));
    }

    
    public function beforeFilter() {
        parent::beforeFilter();
        if (!$this->Session->check('Condo.ViewID')) {
            $this->Session->setFlash(__('Invalid condo'), 'flash/error');
            $this->redirect(array('controller'=>'condos','action' => 'view',$this->Session->read('Condo.ViewID')));
        }
    }
    
    public function beforeRender() {
       $breadcrumbs = array(
            array('link' => Router::url(array('controller' => 'pages', 'action' => 'index')), 'text' => __('Home'), 'active' => ''),
            array('link' => Router::url(array('controller' => 'condos', 'action' => 'index')), 'text' => __n('Condo','Condos',2), 'active' => ''),
            array('link' => Router::url(array('controller' => 'condos', 'action' => 'view', $this->Session->read('Condo.ViewID'))), 'text' => $this->Session->read('Condo.ViewName'), 'active' => ''),
            array('link' => '', 'text' => __n('Maintenance','Maintenances',1), 'active' => 'active')
        );
       switch ($this->action) {
            case 'view':
                 $breadcrumbs[3] = array('link' => Router::url(array('controller' => 'maintenances', 'action' => 'index')), 'text' => __n('Maintenance','Maintenances',1), 'active' => '');
                $breadcrumbs[4] = array('link' => '', 'text' => $this->Session->read('Condo.Maintenance.ViewName'), 'active' => 'active');
                break;
            case 'edit':
                   $breadcrumbs[3] = array('link' => Router::url(array('controller' => 'maintenances', 'action' => 'index')), 'text' => __n('Maintenance','Maintenances',1), 'active' => '');
                $breadcrumbs[4] = array('link' => '', 'text' => $this->Session->read('Condo.Maintenance.ViewName'), 'active' => 'active');
               
                break;
        }
        $this->set(compact('breadcrumbs'));
    }

}
