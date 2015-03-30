<?php

namespace Uniplaces\STest\ListingMatchers;
use Uniplaces\STest\Listing\Listing;


interface MatcherInterface {

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public function isMatch(Listing $listing, $search);
}
