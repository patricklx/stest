<?php

namespace Uniplaces\STest;

use Uniplaces\STest\ListingMatchers\simple;
use Uniplaces\STest\ListingMatchers\advanced;


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
     * @return array of MatcherInterface
     */
    private static function simpleMatchers()
    {
        return [
            new simple\CityMatcher(),
            new simple\StaytimeMatcher(),
            new simple\TenantTypeMatcher()
        ];
    }

    /**
     * @return array of MatcherInterface
     */
    private static function advancedMatchers()
    {
        $simpleMatchers = ListingFinderFactory::simpleMatchers();
        $advancedMatchers = [
            new advanced\AddressMatcher(),
            new advanced\PriceMatcher()
        ];
        return array_merge($simpleMatchers, $advancedMatchers);
    }
}
