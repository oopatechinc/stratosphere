<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Country;
use App\Models\Staff;

class CountriesFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new Country(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        //filters
        if ($this->request->has('is_active') && isset($this->request['is_active'])) {
            $this->query->where('is_active', $this->request['is_active']);
        }

        //appends
        if ($this->request->has('appendStates') && isset($this->request['appendStates'])) {
            $this->query->with('states', function ($query) {
                $query->orderBy('name');
            });
        }

        //orders
        $this->query->orderBy('name');

        return $this;
    }
}
