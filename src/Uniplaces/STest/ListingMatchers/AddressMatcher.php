<?php

namespace Uniplaces\STest\ListingMatchers;
use Uniplaces\STest\Listing\Listing;


class AddressMatcher implements MatcherInterface {

    public function __construct($config = array())
    {
        $this->config = $config;
        if (!isset($this->config['address_levenshtein'])) {
            $this->config['address_levenshtein'] = 5;
        }
    }

    public function isValid(Listing $listing, $search){

        $listingAddress = strtolower(trim($listing->getLocalization()->getAddress()));
        $address = strtolower(trim($search['address']));

        if (levenshtein($listingAddress, $address) > $this->config['address_levenshtein']) {
            return false;
        }

        return true;
    }

    public function canValidate(Listing $listing, $search){
        return isset($search['address']);
    }
}
