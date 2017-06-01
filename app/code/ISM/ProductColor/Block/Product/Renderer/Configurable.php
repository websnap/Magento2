<?php

namespace ISM\ProductColor\Block\Product\Renderer;

use Magento\Catalog\Helper\Product as CatalogProduct;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Source\Status;

class Configurable extends \Magento\Swatches\Block\Product\Renderer\Configurable
{
    /**
     * Get Allowed Products
     *
     * @return \Magento\Catalog\Model\Product[]
     */
    public function getAllowProducts()
    {
        if (!$this->hasAllowProducts()) {
            $products = [];
            $skipSaleableCheck = $this->catalogProduct->getSkipSaleableCheck();
            $allProducts = $this->getProduct()->getTypeInstance()->getUsedProducts($this->getProduct(), null);
            foreach ($allProducts as $product) {
                if ($product->getStatus() == Status::STATUS_ENABLED || $skipSaleableCheck) {
                    $products[] = $product;
                }
            }
            $this->setAllowProducts($products);
        }
        return $this->getData('allow_products');
    }
}
