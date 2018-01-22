<?php

class Esime_Crosssell_Model_System_Config_Source_BestSellersTimeRange
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('crosssell')->__('The last week')),
            array('value' => 1, 'label'=>Mage::helper('crosssell')->__('The last month')),
            array('value' => 2, 'label'=>Mage::helper('crosssell')->__('The last 3 month')),
            array('value' => 3, 'label'=>Mage::helper('crosssell')->__('The last 6 month'))
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
            0 => Mage::helper('crosssell')->__('The last week'),
            1 => Mage::helper('crosssell')->__('The last month'),
            2 => Mage::helper('crosssell')->__('The last 3 month'),
            3 => Mage::helper('crosssell')->__('The last 6 month')
        );
    }

}
