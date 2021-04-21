<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $species_id
 */
class Breed extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'breeds';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'species_id',
    ];
}
