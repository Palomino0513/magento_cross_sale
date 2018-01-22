<?php

class Esime_CrossSell_Model_Resource_Bestsellers_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {

    protected function _construct() {
        parent::_construct();
        $this->_init('crosssell/bestsellers');
    }

}