<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Staff;

class StaffFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Staff(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        //appends
        $this->query->with('user');
        $this->query->with('occupations');
        $this->query->with('address');
        $this->query->with('timeBlocks.dates');
        $this->query->with('services');
        $this->query->with('appointments.serviceVariations');

        return $this;
    }
}
