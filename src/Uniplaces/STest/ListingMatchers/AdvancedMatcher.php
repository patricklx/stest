<?php

namespace Uniplaces\STest\ListingMatchers;


use Uniplaces\STest\Listing\Listing;

class AdvancedMatcher extends SimpleMatcher{

    public function __construct($config = array())
    {
        $this->config = $config;
        if (!isset($this->config['address_levenshtein'])) {
            $this->config['address_levenshtein'] = 5;
        }
    }

    public function isMatch(Listing $listing, $search)
    {
        return  parent::isMatch($listing, $search)
                && $this->matchAddress($listing, $search)
                && $this->matchPrice($listing, $search);
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    private function matchAddress(Listing $listing, $search)
    {
        if (isset($search['address'])) {
            $listingAddress = strtolower(trim($listing->getLocalization()->getAddress()));
            $address = strtolower(trim($search['address']));

            if (levenshtein($listingAddress, $address) > $this->config['address_levenshtein']) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    private function matchPrice(Listing $listing, $search)
    {
        if (isset($search['price'])) {
            $listingPrice = $listing->getPrice();
            $min = isset($search['price']['min']) ? $search['price']['min'] : null;
            $max = isset($search['price']['max']) ? $search['price']['max'] : null;

            if (($min !== null && $min > $listingPrice) || ($max !== null && $max < $listingPrice)) {
                return false;
            }
        }
        return true;
    }
}
