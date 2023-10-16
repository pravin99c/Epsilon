<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;


trait ModelCacheable
{
    /*
    check and load from cache store
    */
    public static function findWithCache($id, $expiredMinutes = 15) {
        $model = new self();

        $modelName = get_class($model);
        if (Cache::store('system-redis')->has($modelName.':'.$id)) {
            $modelArray = $model->fromJson(Cache::get($modelName.':'.$id));
            if ($modelArray != null) {
                return $model->reloadInstanceFromJson($modelArray);
            }
        }

        // if cache not available;
        $model = self::find($id);
        if (empty($model)) {
            return $model;
        }
        Cache::store('system-redis')->put($modelName.':'.$id, $model->toJson(), now()->addMinutes($expiredMinutes));

        return $model;
    }
}


