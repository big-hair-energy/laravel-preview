<?php

namespace BigHairEnergy\Preview;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bhe_preview_keys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['secret'];
}
