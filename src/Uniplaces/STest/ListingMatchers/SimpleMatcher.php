<?php

namespace Uniplaces\STest\ListingMatchers;

use DateTime;
use Uniplaces\STest\Listing\Listing;
use Uniplaces\STest\Requirement\StayTime;
use Uniplaces\STest\Requirement\TenantTypes;

class SimpleMatcher implements MatcherInterface
{
    
    public function isMatch(Listing $listing, $search)
    {
        return $this->matchCity($listing, $search)
                && $this->matchStayTime($listing, $search)
                && $this->matchTenantType($listing, $search);
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    private function matchCity(Listing $listing, $search)
    {
        return $listing->getLocalization()->getCity() == $search['city'];
    }

    /**
     * @param Listing $listing
     * @param $search
     * @return bool
     */
    private function matchStayTime(Listing $listing, $search)
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
    private function matchTenantType(Listing $listing, $search)
    {
        $tenantTypes = $listing->getRequirements()->getTenantTypes();
        if ($tenantTypes instanceof TenantTypes && !in_array($search['occupation'], $tenantTypes->toArray())) {
            return false;
        }
        return true;
    }
}
