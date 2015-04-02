<?php

namespace Uniplaces\STest\ListingMatchers;
use Uniplaces\STest\Listing\Listing;

/**
 * Interface MatcherInterface
 * @package Uniplaces\STest\ListingMatchers
 */
interface MatcherInterface {

    /**
     * @param Listing $listing
     * @param $search
     * @return bool return true when the search matches this matchers' requirements
     */
    public function isValid(Listing $listing, $search);

    /**
     * @param Listing $listing
     * @param $search
     * @return bool returns true when $search and $listing contain the required values for this matcher
     */
    public function canValidate(Listing $listing, $search);
}
