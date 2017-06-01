<?php


namespace ISM\Fred\Plugin\VisualMerchandiser\Model\Config\Source;

use Magento\VisualMerchandiser\Model\Config\Source\AllowedAttributes;

class AllowedAttributesPlugin extends AllowedAttributes
{

    /**
     * @param \Magento\Theme\Block\Html\Pager $subject
     * @param $result
     */
    public function aroundToOptionArray(AllowedAttributes $subject, \Closure $proceed)
    {
        $entityTypeId = $this->type->loadByCode(\Magento\Catalog\Model\Product::ENTITY)->getId();
        if ($entityTypeId) {
            $collection = $this->attribute->getCollection()
                ->removeAllFieldsFromSelect()
                ->addFieldToSelect('attribute_code', 'value')
                ->addFieldToSelect('frontend_label', 'label')
                ->addFieldToFilter('entity_type_id', ['eq' => $entityTypeId]);
//                ->addFieldToFilter('frontend_input', ['neq' => 'multiselect']);
            $attributes = $collection->toArray();
            if (isset($attributes['items'])) {
                $this->options = $attributes['items'];
            }
        }
        return $this->options;
    }
}