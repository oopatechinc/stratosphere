<?php

namespace App\Http\Controllers\FetchManagers;

use App\Abstracts\AbstractFetchManager;
use App\Models\Location;
use App\Models\Staff;

class AppointmentsFetchManager extends AbstractFetchManager
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
        $this->query->with('staff');
        $this->query->with('serviceVariations');

        return $this;
    }
}
