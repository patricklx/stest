<?php

namespace Uniplaces\STest\ListingMatchers\simple;
use Uniplaces\STest\ListingMatchers\MatcherInterface;
use Uniplaces\STest\Listing\Listing;


class CityMatcher implements MatcherInterface {

    public function isValid(Listing $listing, $search){
        return $listing->getLocalization()->getCity() == $search['city'];
    }

    public function canValidate(Listing $listing, $search){
        return isset($search['city']);
    }
}
