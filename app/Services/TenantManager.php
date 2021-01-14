<?php

namespace App\Services;

use App\Models\Tenant;

class TenantManager {
    /*
     * @var null|App\Tenant
     */
    private $tenant;

    public function setTenant(Tenant $tenant) {
        $this->tenant = $tenant;
        return $this;
    }

    public function getTenant() {
        return $this->tenant;
    }

    public function loadTenant($identifier): bool {
        // Identify the tenant here
    }
}
