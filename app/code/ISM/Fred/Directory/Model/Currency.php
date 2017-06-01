<?php

namespace ISM\Fred\Directory\Model;

/**
 * Class Currency
 * @package ISM\Fred\Directory\Model
 */
class Currency extends \Magento\Directory\Model\Currency
{

    /**
     * @param float $price
     * @param array $options
     * @return string
     */
    public function formatTxt($price, $options = [])
    {
        $storeCode = $this->_storeManager->getStore()->getCode();
        if( $storeCode != 'fred_b2c_de' &&  $storeCode != 'shabbies_b2c_de' ) {
            $options['display'] = 1; // Don't show currency symbol
        }

        if (!is_numeric($price)) {
            $price = $this->_localeFormat->getNumber($price);
        }
        /**
         * Fix problem with 12 000 000, 1 200 000
         *
         * %f - the argument is treated as a float, and presented as a floating-point number (locale aware).
         * %F - the argument is treated as a float, and presented as a floating-point number (non-locale aware).
         */
        $price = sprintf("%F", $price);
        return $this->_localeCurrency->getCurrency($this->getCode())->toCurrency($price, $options);
    }

}