<?php

namespace Uniplaces\STest\ListingMatchers\simple;
use DateTime;
use Uniplaces\STest\ListingMatchers\MatcherInterface;
use Uniplaces\STest\Listing\Listing;
use Uniplaces\STest\Requirement\StayTime;


class StaytimeMatcher implements MatcherInterface {

    public function isValid(Listing $listing, $search){
        $stayTime = $listing->getRequirements()->getStayTime();

        /** @var DateTime $startDate */
        $startDate = $search['start_date'];
        /** @var DateTime $endDate */
        $endDate = $search['end_date'];

        $interval = $endDate->diff($startDate);
        $days = (int)$interval->format('%a');

        return ($days >= $stayTime->getMin() && $days <= $stayTime->getMax());
    }

    public function canValidate(Listing $listing, $search){
        $stayTime = $listing->getRequirements()->getStayTime();
        return isset($search['start_date'])
                && isset($search['end_date'])
                && $stayTime instanceof StayTime;
    }
}
