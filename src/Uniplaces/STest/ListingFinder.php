<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;


class ListingFinder implements ListingFinderInterface
{
    /**
     * @var array of MatcherInterface
     */
    protected $matchers;

    /**
     * @param $config
     * @param $matchers of MatcherInterface
     */
    public function __construct($matchers)
    {
        $this->matchers = $matchers;
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
            foreach ($this->matchers as $matcher) {
                if (!$matcher->canValidate($listing, $search)) {
                    continue;
                }
                $matches = $matcher->isValid($listing, $search);
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
