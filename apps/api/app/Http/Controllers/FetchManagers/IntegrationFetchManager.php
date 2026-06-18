<?php

namespace App\Http\Controllers\FetchManagers;

use App\Abstracts\AbstractFetchManager;
use App\Models\Integration;
class IntegrationFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Integration(), $id);
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

        $this->query->where('status', Integration::STATUS_ACTIVE);

        //appends
        $this->query->with(['resources']);

        return $this;
    }
}
