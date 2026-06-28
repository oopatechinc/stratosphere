<?php


namespace App\Http\Controllers\FetchManagers;


use App\Abstracts\AbstractFetchManager;
use App\Models\User;

class UserFetchManager extends AbstractFetchManager
{
    public function __construct($id = null)
    {
        parent::__construct(new User(), $id);
    }

    /**
     * @return AbstractFetchManager
     */
    public function apply()
    {
        $this->query->with(['tenant.vertical.industry']);
        return $this;
    }
}
