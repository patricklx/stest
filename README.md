# Simple test

Simple practical test.

Try to improve as much as possible the code.

The finder class (the rest is just entities an object value):
https://github.com/uniplaces/stest/blob/master/src/Uniplaces/STest/ListingFinder.php

Don't change tests, they all must run:
https://github.com/uniplaces/stest/blob/master/tests/Uniplaces/STest/Tests/FindListingsTest.php#L171

After refactor is expected:
* ListingFinder and ListingFinderFactory should be easy to read in under 20 seconds and understand what it do;
* The size of ListingFinder should be minimum (is just a class to "query");
* Add new "rules" should be easy and shouldn't require to touch ListingFinder code directly;
* Hard coded values on ListingFinder shouldn't be hard coded and should be easy to configure;
* Should be easy to add new type of search eg: 'extra-advanced' without touching the ListingFinder code

## Setup

* Fork
* git clone ...
* cd stest
* curl -sS https://getcomposer.org/installer | php
* php composer.phar install --dev
* Run tests: ./vendor/bin/phpunit


## My procedure
Some things that come to mind

* extract some logic form ListingFinder and put it in ListingFinderFactory

options:

1. create some sort of search API in ListingFinder
    * define some methods like "equal, max, min" ...
    * less flexible but would define some conventions for search
2. or pass matcher functions to the ListingFinder constructor  
    * more flexible, easy to add new rules, no hard coded values, easy to add new types of search
    * ListingFinder code will be minimal
  
-> will do option 2

some notes:

* learned how to dynamically call static functions from other classes
* had to learn about `call_user_func` and `forward_static_call`
* and how to reference the function (needs namespace+class+function)
* finally decided to use ::$functionName
* usage of constants, to allow internal changes, easy name refactoring and better ide autocomplete
* since the constants are strings, it can be easily extended to subdivided the ListingMatchers into more files 
 for different ListingMatcher groups