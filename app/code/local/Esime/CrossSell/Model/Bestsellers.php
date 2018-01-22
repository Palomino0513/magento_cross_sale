<?php

class Esime_CrossSell_Model_Bestsellers extends Mage_Core_Model_Abstract {

    public function _construct() {

        parent::_construct();
        $this->_init('crosssell/bestsellers');
    }

}