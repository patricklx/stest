<?php

namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;
use Uniplaces\STest\ListingMatchers\MatcherInterface;


class ListingFinder implements ListingFinderInterface
{
    /**
     * @var MatcherInterface[]
     */
    protected $matchers;

    /**
     * @param $matchers MatcherInterface[]
     */
    public function __construct($matchers)
    {
        $this->matchers = $matchers;
    }

    /**
     * @param Listing[] $listings
     * @param array     $search
     *
     * applies all matchers to each listing, if all are valid or at least one and the rest is skipped the listing
     * will be included in the result
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
