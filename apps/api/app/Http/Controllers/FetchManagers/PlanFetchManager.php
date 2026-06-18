<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Plan;

class PlanFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Plan(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        $this->query->with('features');
        return $this;
    }
}
