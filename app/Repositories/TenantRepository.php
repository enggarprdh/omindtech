<?php

namespace App\Repositories;

use App\Tenant;

class TenantRepository  {

    protected $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

}