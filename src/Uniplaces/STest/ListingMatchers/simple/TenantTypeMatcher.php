<?php

namespace Uniplaces\STest\ListingMatchers\simple;
use Uniplaces\STest\ListingMatchers\MatcherInterface;
use Uniplaces\STest\Listing\Listing;


class TenantTypeMatcher implements MatcherInterface {

    public function isValid(Listing $listing, $search){
        $tenantTypes = $listing->getRequirements()->getTenantTypes();
        if (!in_array($search['occupation'], $tenantTypes->toArray())) {
            return false;
        }
        return true;
    }

    public function canValidate(Listing $listing, $search){
        $tenantTypes = $listing->getRequirements()->getTenantTypes();
        return isset($search['occupation']) && is_object($tenantTypes);
    }
}
