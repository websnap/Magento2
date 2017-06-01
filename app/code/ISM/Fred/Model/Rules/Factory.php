<?php

namespace ISM\Fred\Model\Rules;

class Factory extends \Magento\VisualMerchandiser\Model\Rules\Factory
{

    /**
     * @param array $rule
     * @return \Magento\VisualMerchandiser\Model\Rules\RuleInterface
     */
    public function create(array $rule)
    {
        if ($this->attribute->getAttributeCode() != $rule['attribute']) {
            $this->attribute = $this->objectManager->create('\Magento\Catalog\Model\ResourceModel\Eav\Attribute');
        }

        return parent::create($rule);
    }

}
