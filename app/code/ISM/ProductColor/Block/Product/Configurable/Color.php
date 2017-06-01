<?php

namespace ISM\ProductColor\Block\Product\Configurable;

use \Magento\Catalog\Block\Product\Context;
use \Magento\Framework\Stdlib\ArrayUtils;
use \Magento\Framework\Json\EncoderInterface;
use \Magento\ConfigurableProduct\Helper\Data;
use \Magento\Catalog\Helper\Product;
use \Magento\ConfigurableProduct\Model\ConfigurableAttributeData;
use \Magento\Customer\Helper\Session\CurrentCustomer;
use \Magento\Framework\Pricing\PriceCurrencyInterface;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use \Magento\Swatches\Helper\Media as MediaHelper;
use \Magento\Swatches\Helper\Data as SwatchHelper;

class Color extends \Magento\ConfigurableProduct\Block\Product\View\Type\Configurable
{

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var MediaHelper
     */
    protected $mediaHelper;

    /**
     * @var SwatchHelper
     */
    protected $swatchHelper;

    public function __construct(
        Context $context,
        ArrayUtils $arrayUtils,
        EncoderInterface $jsonEncoder,
        Data $helper,
        Product $catalogProduct,
        CurrentCustomer $currentCustomer,
        PriceCurrencyInterface $priceCurrency,
        ConfigurableAttributeData $configurableAttributeData,
        CollectionFactory $collectionFactory,
        MediaHelper $mediaHelper,
        SwatchHelper $swatchHelper,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->mediaHelper = $mediaHelper;
        $this->swatchHelper = $swatchHelper;

        parent::__construct(
            $context,
            $arrayUtils,
            $jsonEncoder,
            $helper,
            $catalogProduct,
            $currentCustomer,
            $priceCurrency,
            $configurableAttributeData,
            $data = []
        );
    }

    public function getRelatedProducts($product)
    {
        if (!$product || $product->getTypeId() !== 'configurable') return [];
        $artikelcode = $product->getArtikelcode();

        $collection = $this->collectionFactory->create();
        $collection
            ->addAttributeToSelect('kleur')
            ->addAttributeToFilter('type_id', 'configurable')
            ->addAttributeToFilter('artikelcode', $artikelcode)
            ->addAttributeToFilter('kleur', ['notnull' => true])
            ->addUrlRewrite()
            ->joinAttribute('attr_status', 'catalog_product/status', 'entity_id', null, 'inner')
            //filter by attr_status=1
            ->getSelect()->where('IF(at_attr_status.value_id > 0, at_attr_status.value, at_attr_status_default.value) = 1');

        $this->addSwatches($collection);

        return $collection->getItems();
    }

    protected function addSwatches($productCollection)
    {
        $kelurOptionsIds = [];
        foreach ($productCollection->getitems() as $product) {
            $kelurOptionsIds[] = $product->getKleur();
        }

        if (empty($kelurOptionsIds)) return false;

        $swatches = $this->swatchHelper->getSwatchesByOptionsId($kelurOptionsIds);

        foreach ($productCollection->getitems() as $product) {
            if (isset($swatches[$product->getKleur()])) {
                $product->setData('swatch', $swatches[$product->getKleur()]);
            }
        }

        return true;
    }

    /**
     * @param string $type
     * @param string $filename
     * @return string
     */
    public function getSwatchPath($type, $filename)
    {
        $imagePath = $this->mediaHelper->getSwatchAttributeImage($type, $filename);

        return $imagePath;
    }

}
