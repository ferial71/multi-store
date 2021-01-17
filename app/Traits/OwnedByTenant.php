<?php
namespace App\Traits;

use App\Models\Tenant;
use App\Scopes\TenantOwnedScope;
use App\Services\TenantManager;

trait OwnedByTenant {
    public static function bootOwnedByTenant() {
        static::addGlobalScope(new TenantOwnedScope);
        static::creating(function ($model) {


            if (! $model->tenant_id && ! $model->relationLoaded('tenant')) {
//                $model->setRelation('tenant', Tenant::first());
                $model->tenant_id =app(TenantManager::class)->getTenant()->id;
                $model->setRelation('tenant', app(TenantManager::class)->getTenant()->id);
//                $model->save();
            }
//            dd(app(TenantManager::class)->getTenant());
            return $model;
        });
    }

    public function tenant() {
        $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
