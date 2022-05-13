<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\ActivityLog\Traits\LogsActivity;


class ActivityLog extends Model
{
    use LogsActivity;

    protected $table = 'activity_log';

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id', 'id');
    }
}
