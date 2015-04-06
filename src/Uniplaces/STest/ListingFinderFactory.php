<?php

namespace Uniplaces\STest;

use Uniplaces\STest\ListingMatchers\advanced\AddressMatcher;
use Uniplaces\STest\ListingMatchers\advanced\PriceMatcher;
use Uniplaces\STest\ListingMatchers\MatcherInterface;
use Uniplaces\STest\ListingMatchers\simple\CityMatcher;
use Uniplaces\STest\ListingMatchers\simple\StaytimeMatcher;
use Uniplaces\STest\ListingMatchers\simple\TenantTypeMatcher;


/**
 * ListingFinderFactory
 */
abstract class ListingFinderFactory
{
    /**
     * @return ListingFinderInterface
     */
    public static function createSimple()
    {
        $matcherClasses = ListingFinderFactory::simpleMatchers();
        return new ListingFinder($matcherClasses);
    }

    /**
     * @return ListingFinderInterface
     */
    public static function createAdvanced()
    {
        $matcherClasses = ListingFinderFactory::advancedMatchers();
        return new ListingFinder($matcherClasses);
    }

    /**
     * @return MatcherInterface[]
     */
    private static function simpleMatchers()
    {
        return [
            new CityMatcher(),
            new StaytimeMatcher(),
            new TenantTypeMatcher()
        ];
    }

    /**
     * @return MatcherInterface[]
     */
    private static function advancedMatchers()
    {
        $simpleMatchers = ListingFinderFactory::simpleMatchers();
        $advancedMatchers = [
            new AddressMatcher(),
            new PriceMatcher()
        ];
        return array_merge($simpleMatchers, $advancedMatchers);
    }
}
