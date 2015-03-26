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
        return new ListingFinder($matchFunctions);
    }

    /**
     * @return ListingFinderInterface
     */
    public static function createAdvanced()
    {
        $matchFunctions = ListingFinderFactory::advancedMatchers();
        return new ListingFinder($matchFunctions);
    }

    /**
     * @return array of matchers
     */
    private static function simpleMatchers()
    {
        return [
            __NAMESPACE__ .'\ListingMatchers::matchCity',
            __NAMESPACE__ .'\ListingMatchers::matchStayTime',
            __NAMESPACE__ .'\ListingMatchers::matchTenantType'
        ];
    }

    /**
     * @return array of matchers
     */
    private static function advancedMatchers()
    {
        $matchers = ListingFinderFactory::simpleMatchers();
        $advancedMatchers = [
            __NAMESPACE__ .'\ListingMatchers::matchAddress',
            __NAMESPACE__ .'\ListingMatchers::matchPrice'
        ];
        $matchers = array_merge($matchers, $advancedMatchers);
        return $matchers;
    }
}
