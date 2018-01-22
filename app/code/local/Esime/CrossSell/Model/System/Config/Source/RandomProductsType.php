<?php

class Esime_Crosssell_Model_System_Config_Source_RandomProductsType
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('crosssell')->__('Current Category')),
            array('value' => 1, 'label'=>Mage::helper('crosssell')->__('Product Category'))
        );
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return array(
            0 => Mage::helper('crosssell')->__('Current Category'),
            1 => Mage::helper('crosssell')->__('Product Category')
        );
    }

}