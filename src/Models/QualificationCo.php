<?php

namespace Qihucms\Qualification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualificationCo extends Model
{
    protected $fillable = [
        'user_id', 'company_name', 'company_id', 'files', 'contacts',
        'mobile', 'email', 'address', 'status'
    ];

    protected $casts = [
        'files' => 'array',
    ];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
