<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;


class ListingFinder implements ListingFinderInterface
{
    /**
     * @var array of matcher classes
     */
    protected $matchers;

    /**
     * @param $config
     * @param $matcherNames array of function($listing, $search, $config (optional))
     */
    public function __construct($matchers)
    {
        $this->matchers = $matchers;
    }

    /**
     * @param Listing[] $listings
     * @param array     $search
     *
     * an listing is included if all matchfunctions return true
     * @return Listing[]
     */
    public function reduce(array $listings, array $search)
    {
        $matchListings = array();

        foreach ($listings as $listing) {

            $matches = false;
            foreach ($this->matchers as $matcher) {

                $matches = $matcher->isMatch($listing, $search);
                if (!$matches) {
                    break;
                }
            }
            if ($matches) {
                $matchListings[] = $listing;
            }
        }
        return $matchListings;
    }
}
