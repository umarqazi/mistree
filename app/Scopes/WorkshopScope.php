<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WorkshopScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */

    public function apply(Builder $builder, Model $model)
    {
        $builder->with(['images','address','services','balance','billings' => function($query){
            $query->where('ratings', '<>', NULL)->orderBy('ratings', 'DESC');
        }]);
    }
}