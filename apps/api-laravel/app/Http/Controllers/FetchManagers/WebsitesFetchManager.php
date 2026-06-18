<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\Website;

class WebsitesFetchManager extends AbstractFetchManager
{
    public function __construct($adminId = null)
    {
        parent::__construct(new Website(), $adminId);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        $this->query->with('template');
        return $this;
    }
}
