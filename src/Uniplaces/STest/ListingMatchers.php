<?php
namespace Uniplaces\STest;

use Uniplaces\STest\Listing\Listing;
use Uniplaces\STest\Requirement\StayTime;
use Uniplaces\STest\Requirement\TenantTypes;
use DateTime;

abstract class ListingMatchers
{
    /**
     * @return array  default configuration for matcher methods
     */
    public static function defaultConfig()
    {
        return array(
          'address_levenstein' => 5
        );
    }
    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public static function matchCity(Listing $listing, $search)
    {
        return $listing->getLocalization()->getCity() == $search['city'];
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public static function matchStayTime(Listing $listing, $search)
    {
        $stayTime = $listing->getRequirements()->getStayTime();
        if (isset($search['start_date']) && $stayTime instanceof StayTime) {
            /** @var DateTime $startDate */
            $startDate = $search['start_date'];
            /** @var DateTime $endDate */
            $endDate = $search['end_date'];

            $interval = $endDate->diff($startDate);
            $days = (int)$interval->format('%a');

            return ($days >= $stayTime->getMin() && $days <= $stayTime->getMax());
        }
        return true;
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public static function matchTenantType(Listing $listing, $search)
    {
        $tenantTypes = $listing->getRequirements()->getTenantTypes();
        if ($tenantTypes instanceof TenantTypes && !in_array($search['occupation'], $tenantTypes->toArray())) {
            return false;
        }
        return true;
    }

    /**
     * @param Listing $listing
     * @param $search
     * @param $config
     * @return bool
     */
    public static function matchAddress(Listing $listing, $search, $config)
    {
        if (isset($search['address'])) {
            $listingAddress = strtolower(trim($listing->getLocalization()->getAddress()));
            $address = strtolower(trim($search['address']));

            if (levenshtein($listingAddress, $address) > $config['address_levenstein']) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    public static function matchPrice(Listing $listing, $search)
    {
        if (isset($search['price'])) {
            $listingPrice = $listing->getPrice();
            $min = isset($search['price']['min']) ? $search['price']['min'] : null;
            $max = isset($search['price']['max']) ? $search['price']['max'] : null;

            if (($min !== null && $min > $listingPrice) || ($max !== null && $max < $listingPrice)) {
                return false;
            }
        }
        return true;
    }
}
