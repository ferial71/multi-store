<?php
namespace App\Concerns;

use App\Models\Tenant;
use App\Scopes\TenantOwnedScope;

trait OwnedByTenant {
    public static function bootOwnedByTenant() {
        static::addGlobalScope(new TenantOwnedScope);
    }

    public function tenant() {
        $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
