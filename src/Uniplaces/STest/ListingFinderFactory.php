<?php

namespace Uniplaces\STest;

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
        $matchFunctions = ListingFinderFactory::simpleMatchers();
        $config = ListingMatchers::defaultConfig();
        return new ListingFinder($config, $matchFunctions);
    }

    /**
     * @return ListingFinderInterface
     */
    public static function createAdvanced()
    {
        $matchFunctions = ListingFinderFactory::advancedMatchers();
        $config = ListingMatchers::defaultConfig();
        return new ListingFinder($config, $matchFunctions);
    }

    /**
     * @return array of matcherNames
     */
    private static function simpleMatchers()
    {
        return [
            ListingMatchers::MATCH_CITY,
            ListingMatchers::MATCH_STAYTIME,
            ListingMatchers::MATCH_TENANTTYPE
        ];
    }

    /**
     * @return array of matcherNames
     */
    private static function advancedMatchers()
    {
        $simpleMatchers = ListingFinderFactory::simpleMatchers();
        $advancedMatchers = [
            ListingMatchers::MATCH_ADDRESS,
            ListingMatchers::MATCH_PRICE
        ];
        $matchers = array_merge($simpleMatchers, $advancedMatchers);
        return $matchers;
    }
}
