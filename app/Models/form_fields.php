<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_fields extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_id',
        'field_name',
        'field_type',
        'field_value'
    ];

    public function files()
    {
        return $this->belongsTo('App\models\files','file_id');
    }

}
