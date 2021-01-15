<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Services\TenantManager;

class TenantOwnedScope implements Scope {
    public function apply(Builder $builder, Model $model) {
        $manager = app(TenantManager::class);
        $builder->where('tenant_id', '=', $manager->getTenant()->id);
    }
}
