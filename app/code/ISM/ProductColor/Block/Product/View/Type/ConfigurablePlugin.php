<?php

namespace ISM\ProductColor\Block\Product\View\Type;

use \Magento\CatalogInventory\Api\StockStateInterface;
use Magento\Framework\Json\EncoderInterface;

class ConfigurablePlugin
{
    protected $stockInterface;
    protected $encoderInterface;

    public function __construct(StockStateInterface $stockInterface,
                                EncoderInterface $encoderInterface)
    {
        $this->stockInterface = $stockInterface;
        $this->encoderInterface = $encoderInterface;
    }

    public function afterGetJsonConfig($subject, $result)
    {
        $product = $subject->getProduct();
        $config = json_decode($result);
        $attrSizeId = $product->getResource()->getAttribute('maat')->getId();

        if (isset($config->attributes->{$attrSizeId}->options)) {
            foreach ($config->attributes->{$attrSizeId}->options as $option) {
                if (isset($option->products[0])) {
                    $stock = $this->stockInterface->getStockQty($option->products[0], $product->getStore()->getWebsiteId());
                    $option->isInStock = boolval($stock);
                }
            }
            return $this->encoderInterface->encode($config);
        } else {
            return $result;
        }
    }

}
