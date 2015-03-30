<?php

namespace Uniplaces\STest;

use Uniplaces\STest\ListingMatchers\SimpleMatcher;
use Uniplaces\STest\ListingMatchers\AdvancedMatcher;
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
     * @return array of matcherNames
     */
    private static function simpleMatchers()
    {
        return [
            new SimpleMatcher()
        ];
    }

    /**
     * @return array of matcherNames
     */
    private static function advancedMatchers()
    {
        return [
            new AdvancedMatcher()
        ];
    }
}
