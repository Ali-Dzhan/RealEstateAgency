<?php
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('auditLogExport')) {
    /**
     * Log CSV export action in audit logs.
     */
    function auditLogExport($user, string $type): void
    {
        try {
            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'export_' . $type,
                'entity' => 'offers',
                'entity_id' => 0,
            ]);
        } catch (\Throwable $e) {
            \Log::warning('Audit export log failed: ' . $e->getMessage());
        }
    }
}
