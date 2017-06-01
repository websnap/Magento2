<?php
namespace ISM\Fred\Helper;
use Magento\CatalogInventory\Api\StockStateInterface;
use Magento\Framework\Json\EncoderInterface;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableProductType;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const SIZE_ATTRIBUTE_NAME = "maat";
    const COLOR_ATTRIBUTE_NAME = "kleur";

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var StockStateInterface
     */
    private $stockStateInterface;

    /**
     * Constructor
     * @param StockStateInterface $stockStateInterface
     * @param EncoderInterface $encoder
     */
    public function __construct(
        StockStateInterface $stockStateInterface,
        EncoderInterface $encoder
    )
    {
        $this->stockStateInterface = $stockStateInterface;
        $this->encoder = $encoder;
    }

    public function getProductStock($productId, $websiteId)
    {
        return $this->stockStateInterface->getStockQty($productId, $websiteId);
    }

    public function getNotAvailableOptions($product)
    {
        if ($product->getTypeId() === ConfigurableProductType::TYPE_CODE) {
            $childProducts = $product->getTypeInstance()->getUsedProducts($product);
            $data = [];
            foreach ($childProducts as $child) {
                if ($this->getProductStock($child->getId(), $child->getStore()->getWebsiteId()) == 0) {
                    $data[$child->getData(self::COLOR_ATTRIBUTE_NAME)][] = $child->getData(self::SIZE_ATTRIBUTE_NAME);
                }
            }
            return (count($data) > 0) ? $this->encoder->encode($data) : null;
        }
        return null;
    }

    /**
     * @param $items
     * @param $num
     * @return array of data | bool
     */
    public function getImageData ($items, $num)
    {
        if(isset($items[$num])) {
            return $items[$num]->getData();
        }
        return false;
    }

}