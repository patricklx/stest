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
     * @param $matchFunctions array of function($listing, $functions)
     */
    public function __construct($matchFunctions)
    {
        $this->matchFunctions = $matchFunctions;
    }

    /**
     * @param Listing[] $listings
     * @param array     $search
     *
     * @return Listing[]
     */
    public function reduce(array $listings, array $search)
    {
        $matchListings = array();

        foreach ($listings as $listing) {

            $matches = false;
            foreach ($this->matchFunctions as $matchFn) {

                $matches = call_user_func($matchFn, $listing, $search);
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
