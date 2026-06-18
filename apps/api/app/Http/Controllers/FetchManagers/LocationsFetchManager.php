<?php

namespace App\Http\Controllers\FetchManagers;

use App\Abstracts\AbstractFetchManager;
use App\Models\Location;
use App\Models\Staff;

class LocationsFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Location(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        //filters
        if ($this->request->has('tenant_id') && isset($this->request['tenant_id'])) {
            $this->query->where('tenant_id', $this->request['tenant_id']);
        }

        // appends
        $this->query->with('address');
        $this->query->with('openingDays.OpeningHours');
        $this->query->with('openingHourExceptions');
        $this->query->with('tenant.services.variations.service');
        $this->query->with('tenant.staff.user');
        $this->query->with('services.variations.service');
        $this->query->with('staff.user');
        $this->query->with('staff.services.variations.service');
        $this->query->with('websiteContents');

        return $this;
    }
}
