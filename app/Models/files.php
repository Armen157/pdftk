<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    use HasFactory;

    protected $primaryKey = 'file_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file_name','content','file_type_id'
    ];

    public function file_types()
    {
        return $this->belongsTo('App\models\file_types','file_type_id');
    }

}
