<?php

namespace Qihucms\Qualification\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QualificationPa extends Model
{
    protected $fillable = [
        'user_id', 'real_name', 'id_card_no', 'files', 'status'
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
