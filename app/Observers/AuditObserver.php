<?php

namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;

class AuditObserver
{
    public function created(Model $model)
    {
        $this->log('created', $model);
    }

    public function updated(Model $model)
    {
        $this->log('updated', $model);
    }

    public function deleted(Model $model)
    {
        $this->log('deleted', $model);
    }

    protected function log($action, Model $model)
    {
        $userId = auth()->id() ?? optional(request()->user())->id ?? null;

        if (!$userId) {
            return;
        }

        // avoid logging the AuditLog itself to prevent infinite loops
        if ($model instanceof AuditLog) {
            return;
        }

        AuditLog::create([
            'user_id'   => $userId,
            'action'    => $action,
            'entity'    => $model->getTable(),
            'entity_id' => $model->id,
        ]);
    }
}
