<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Guest;

class GuestFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Guest(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        return $this;
    }
}
