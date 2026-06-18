<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Staff;
use App\Models\Tenant;

class TenantsFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Tenant(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        $this->query->with('vertical.industry');
        return $this;
    }
}
