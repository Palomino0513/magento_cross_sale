<?php

/**
 * Cart crosssell list
 *
 * @package     Esime_CrossSell
 * @author      Jose Ivan Palomino Rodriguez
 */
class Esime_CrossSell_Block_Cart_Crosssell extends Mage_Checkout_Block_Cart_Crosssell
{
    /**
     * Retrieve current product model
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct() {
        if (!Mage::registry('product') && $this->getProductId()) {
            $product = Mage::getModel('catalog/product')->load($this->getProductId());
            Mage::register('product', $product);
        }
        return Mage::registry('product');
    }

    /**
     * Get store module configuration
     * @param config
     * @return string
     */
    public function getStoreConfig($config) {
        //
        $routeConfiguration = (Mage::getSingleton('customer/session')->isLoggedIn() ? 'crosssell/customer_config' : 'crosssell/guest_config');
        //
        if ($config == "viewed") {
            return ($routeConfiguration == 'crosssell/customer_config' ? Mage::getStoreConfig($routeConfiguration.'/viewed') : '');
        }
        return Mage::getStoreConfig($routeConfiguration.'/'.$config);
    }

    /**
     * randomized array
     * @param array     $originalArray
     * @param int       $nItems
     * @return array    resultArray
     */
    public function randomizedArray($originalArray, $nItems = -1) {
        $nItems = ($nItems == -1 ? count($originalArray) : $nItems);
        $resultArray = [];
        //
        foreach (array_rand($originalArray, $nItems) as $itemId) {
            $resultArray[] = $originalArray[$itemId];
        }
        return $resultArray;
    }

    /**
     * Get crosssell items
     * @return array
     */
    public function getItems() {
        // $items = $this->getData('items');
        // if (is_null($items)) {
        $items = array();

        // get items only recommended products module has enabled
        if ($this->getStoreConfig('enabled') == 1) {
            Mage::log('::::::::::::::::::::::::::::::::::::::::::');

            // get products by administrator select in the products configuration page and
            // the  products stay in the shopping cart
            foreach ($this->getSelectedItems() as $selectedItem) {
                $items[] = Mage::getModel('catalog/product')->load($selectedItem);
            }
            Mage::log(count($items));

            // get best sellers products in the store
            foreach ($this->getBestSellersItems() as $bestSeller) {
                $items[] = Mage::getModel('catalog/product')->load($bestSeller);
            }
            Mage::log(count($items));

            // if user is customer, show recently viewed products
            if (Mage::getSingleton('customer/session')->isLoggedIn()) {
                //$this->getRecentlyViewedProducts();
            }
        }

        $this->setData('items', $items);
        // }
        return $items;
    }

    /**
    * Get
    * @return array
    */
    public function getSelectedItems() {
        // array result initialization
        $selectedProducts = array();
        // selected product by admin
        $cart = Mage::getModel('checkout/cart')->getQuote();
        foreach ($cart->getAllItems() as $item) {
            // get recommended product que administrator select in the magento admin
            $product = Mage::getModel('catalog/product')->load($item->getParentItemId() ? $item->getParentItemId() : $item->getProductId());
            // append products in the result array
            foreach ($product->getCrossSellProducts() as $selectedProduct) {
                $selectedProducts[] = $selectedProduct->getEntityId();
            }
        }
        //
        $selectedProductsConfig = intval($this->getStoreConfig('selected'));

        Mage::log($selectedProductsConfig . ' <- selected');

        //
        if (count($selectedProducts) <= $selectedProductsConfig) {
            return $selectedProducts;
        } else {
            $newSelectedProducts = array();
            foreach (array_rand($selectedProducts, $selectedProductsConfig) as $itemId) {
                $newSelectedProducts[] = $selectedProducts[$itemId];
            }
            return $newSelectedProducts;
        }
    }

    /**
     *  Get best sellers products in the store
     * @param bool      $randomized
     * @param int       $nItems
     * @return array
     */
    public function getBestSellersItems($randomized = true, $nItems = -1) {
        $bestSellers = Mage::getModel('crosssell/bestsellers')->getCollection();
        $nItems = ($nItems == -1 ? intval($this->getStoreConfig('bestsellers')) : $nItems);
        $bestSellersProducts = array();
        //
        foreach ($bestSellers as $item) {
            $bestSellersProducts[] = $item->getProductId();
        }
        //
        if (count($bestSellersProducts) >= $nItems && $randomized) {
            $bestSellersProducts = $this->randomizedArray($bestSellersProducts, $nItems);
        } else if (count($bestSellersProducts) >= $nItems) {
            //////////////////////////////////////////////////////////////////////////////////////////////////////
            //    Slice array
            $bestSellersProducts = $this->randomizedArray($bestSellersProducts, $nItems);
            //////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        return $bestSellersProducts;
    }

    /**
     * Get
     * @return array
     */
    public function getRecentlyViewedProducts() {
        $bestSellersConfig = intval($this->getStoreConfig('viewed'));
        $recentlyViewed = Mage::getModel('reports/product_index_viewed')
            ->getCollection()
            ->addFieldToFilter('is_salable', '1')
            ->load();
        /*+
        [stock_item (Varien_Object)] => Array
        (
            [is_in_stock] => 1
        )
        */
        $recentlyViewed->getSelect()->limit($bestSellersConfig);
        $recentlyViewedProducts = array();

        Mage::log('..........................................');
        foreach ($recentlyViewed as $viewedProduct) {
            Mage::log($viewedProduct->getEntityId());
        }

        return $recentlyViewedProducts ;
    }
}
