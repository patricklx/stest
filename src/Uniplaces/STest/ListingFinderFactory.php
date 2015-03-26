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
     * @return array of matchers
     */
    private static function simpleMatchers()
    {
        $prefix = __NAMESPACE__ .'\ListingMatchers::';
        return [
            $prefix.'matchCity',
            $prefix.'matchStayTime',
            $prefix.'matchTenantType'
        ];
    }

    /**
     * @return array of matchers
     */
    private static function advancedMatchers()
    {
        $prefix = __NAMESPACE__ .'\ListingMatchers::';
        $matchers = ListingFinderFactory::simpleMatchers();
        $advancedMatchers = [
            $prefix.'matchAddress',
            $prefix.'matchPrice'
        ];
        $matchers = array_merge($matchers, $advancedMatchers);
        return $matchers;
    }
}
