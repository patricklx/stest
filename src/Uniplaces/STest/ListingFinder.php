<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;


class ListingFinder implements ListingFinderInterface
{
    /**
     * @var array of functions
     */
    protected $matchFunctions;

    /**
     * @var array configs for matchers
     */
    protected $config;

    /**
     * @param $config
     * @param $matchFunctions array of function($listing, $search, $config (optional))
     */
    public function __construct($config, $matchFunctions)
    {
        $this->config = $config;
        $this->matchFunctions = $matchFunctions;
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
            foreach ($this->matchFunctions as $matchFn) {

                $matches = call_user_func($matchFn, $listing, $search, $this->config);
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
