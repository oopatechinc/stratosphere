<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Occupation;

class OccupationFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Occupation(), $id);
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

        return $this;
    }
}
