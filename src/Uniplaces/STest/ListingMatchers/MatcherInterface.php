<?php

namespace Uniplaces\STest\ListingMatchers;
use Uniplaces\STest\Listing\Listing;


interface MatcherInterface {

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public function isValid(Listing $listing, $search);

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public function canValidate(Listing $listing, $search);
}
