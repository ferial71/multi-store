<?php

namespace App\Services;

use App\Models\Tenant;
use PhpParser\Node\Scalar\String_;

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

    public function loadTenant($identifier, $subdomain){
        $tenant = Tenant::query()->where($subdomain ? 'subdomain' : 'domain', '=', $identifier)->first();

        if ($tenant) {
            $this->setTenant($tenant);
            return true;
        }

        return false;
    }
//    public static function unique($table, $column = 'NULL')
//    {
//        return (new Rules\Unique($table, $column))->where('tenant_id', $this->getTenant()->id);
//    }
//
//    public static function exists($table, $column = 'NULL')
//    {
//        return (new Rules\Exists($table, $column))->where('tenant_id', $this->getTenant()->id);
//    }
}
