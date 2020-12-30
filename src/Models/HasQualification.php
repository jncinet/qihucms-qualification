<?php

namespace Qihucms\Qualification\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasQualification
{
    public function qualification_co(): HasOne
    {
        return $this->hasOne('Qihucms\Qualification\Models\QualificationCo', 'user_id');
    }

    public function qualification_pa(): HasOne
    {
        return $this->hasOne('Qihucms\Qualification\Models\QualificationPa', 'user_id');
    }
}