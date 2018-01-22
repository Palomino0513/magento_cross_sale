<?php

class Esime_Crosssell_Model_System_Config_Source_Items
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('crosssell')->__('0')),
            array('value' => 1, 'label'=>Mage::helper('crosssell')->__('1')),
            array('value' => 2, 'label'=>Mage::helper('crosssell')->__('2')),
            array('value' => 3, 'label'=>Mage::helper('crosssell')->__('3')),
            array('value' => 4, 'label'=>Mage::helper('crosssell')->__('4')),
            array('value' => 5, 'label'=>Mage::helper('crosssell')->__('5')),
            array('value' => 6, 'label'=>Mage::helper('crosssell')->__('6')),
            array('value' => 7, 'label'=>Mage::helper('crosssell')->__('7')),
            array('value' => 8, 'label'=>Mage::helper('crosssell')->__('8')),
            array('value' => 9, 'label'=>Mage::helper('crosssell')->__('9')),
            array('value' => 10, 'label'=>Mage::helper('crosssell')->__('10')),
            array('value' => 11, 'label'=>Mage::helper('crosssell')->__('11')),
            array('value' => 12, 'label'=>Mage::helper('crosssell')->__('12')),
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
            0 => Mage::helper('crosssell')->__('0'),
            1 => Mage::helper('crosssell')->__('1'),
            2 => Mage::helper('crosssell')->__('2'),
            3 => Mage::helper('crosssell')->__('3'),
            4 => Mage::helper('crosssell')->__('4'),
            5 => Mage::helper('crosssell')->__('5'),
            6 => Mage::helper('crosssell')->__('6'),
            7 => Mage::helper('crosssell')->__('7'),
            8 => Mage::helper('crosssell')->__('8'),
            9 => Mage::helper('crosssell')->__('9'),
            10 => Mage::helper('crosssell')->__('10'),
            11 => Mage::helper('crosssell')->__('11'),
            12 => Mage::helper('crosssell')->__('12'),
        );
    }

}
