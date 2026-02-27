<?php

namespace App\Traits;

use App\Models\Log;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        // Logger les suppressions uniquement
        static::deleted(function ($model) {
            $modelName = class_basename($model);
            Log::logAction('suppression', "Suppression d'un(e) {$modelName} (ID: {$model->id})");
        });
    }
}
