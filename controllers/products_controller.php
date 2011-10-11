<?php

class ProductsController extends ProductsAppController{

	public $components = array('Cart.CartManager','Search.Prg');
	
	public $conditions = array('active' => 1);
	
	/**
	 * for search plugin
	 * @var unknown_type
	 */
	public $presetVars = array();
	
	
	public function beforeFilter(){
		if(!empty($this->Auth)){
			$this->Auth->allow('index','view');
		}
		parent::beforeFilter();
	}

	public function index(){
		$products = $this->paginate($this->conditions);
		$this->set(compact('products'));
	}
	
	public function view($id){
		$product = $this->Product->findById($id);
		$this->set(compact('product'));
	}
	
	public function admin_index(){
		//search plugin related
		$this->Prg->commonProcess();
		if(!empty($this->params['named'])){
			$this->data['Product'] = $this->params['named'];
		}
		$this->paginate['conditions'] = $this->Product->parseCriteria($this->passedArgs);
		
		$products = $this->paginate();
		$activeOptions = $this->Product->activeOptions;		
		$this->set(compact('products','activeOptions'));
	}
	
	public function admin_edit($id = null){
		if(empty($id)){
			$this->redirect(array('action'=>'index'));
		}
		$activeOptions = $this->Product->activeOptions;
		if(!empty($this->data)){
			$this->_save();
		}
		$this->data = $this->Product->findById($id);
		$this->set(compact('activeOptions','id'));
	}

	public function admin_add(){
		if(!empty($this->data)){
			if($this->_save()){
				$this->redirect(array('action'=>'index'));
			}
		}
		$activeOptions = $this->Product->activeOptions;
		$this->set(compact('activeOptions'));
	}
	
	public function admin_delete($id = null) {
		if ($this->Product->delete($id)) {
			$this->Session->setFlash(__("Product deleted", true));
		}
		$this->redirect(array('action' => 'index'));
	}
	
	public function admin_delete_image($id,$product_id){
		if ($this->Product->Image->delete($id)) {
			$this->Session->setFlash(__("Image deleted", true));
		}
		$this->redirect(array('action' => 'edit',$product_id));
	}

	private function _save($edit = false){
		if(!empty($this->data['price'])){
			$this->data['total_price'] = $this->data['price'];
		}
		if($this->Product->saveAll($this->data)){
			$this->Session->setFlash(__('Product has been saved.', true));
			return true;
		} else{
			$this->Session->setFlash(__('Product could not be saved. Please correct errors and try again.', true));
		}
		return false;
	}

}