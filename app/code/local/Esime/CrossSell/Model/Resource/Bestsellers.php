<?php

class Esime_CrossSell_Model_Resource_Bestsellers extends Mage_Core_Model_Resource_Db_Abstract {

    protected function _construct() {
        $this->_init('crosssell/bestsellers', 'id');
    }

}