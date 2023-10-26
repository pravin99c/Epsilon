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
        if (Cache::has($modelName.':'.$id)) {
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
        Cache::put($modelName.':'.$id, $model->toJson(), now()->addMinutes($expiredMinutes));

        return $model;
    }

    private function reloadInstanceFromJson($data)
    {
        $cachedModel = $this->newInstance($data);
        $cachedModel->id = $data['id'];

        foreach ($data as $key => $value) {
            if (! in_array($key, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }
            if (! isset($cachedModel->$key) && ! is_array($data[$key])) {
                $cachedModel->$key = $value;
            }
        }

        return $cachedModel;
    }
}


