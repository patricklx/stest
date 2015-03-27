<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;


class ListingFinder implements ListingFinderInterface
{
    /**
     * @var array of functions
     */
    protected $matcherNames;

    /**
     * @var array configs for matchers
     */
    protected $config;

    /**
     * @param $config
     * @param $matcherNames array of function($listing, $search, $config (optional))
     */
    public function __construct($config, $matcherNames)
    {
        $this->config = $config;
        $this->matcherNames = $matcherNames;
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
            foreach ($this->matcherNames as $matcherName) {

                $matches = ListingMatchers::callMatcher($matcherName, $listing, $search, $this->config);
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
