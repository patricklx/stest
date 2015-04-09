<?php

namespace Uniplaces\STest\ListingMatchers\advanced;
use Uniplaces\STest\ListingMatchers\MatcherInterface;
use Uniplaces\STest\Listing\Listing;


class PriceMatcher implements MatcherInterface {

    public function isValid(Listing $listing, $search){

        $listingPrice = $listing->getPrice();
        $min = isset($search['price']['min']) ? $search['price']['min'] : null;
        $max = isset($search['price']['max']) ? $search['price']['max'] : null;

        if (($min !== null && $min > $listingPrice) || ($max !== null && $max < $listingPrice)) {
            return false;
        }
        return true;
    }

    public function canValidate(Listing $listing, $search){
        return isset($search['price']);
    }
}
