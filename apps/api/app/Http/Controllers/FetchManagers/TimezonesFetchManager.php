<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Timezone;

class TimezonesFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Timezone(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        return $this;
    }
}
