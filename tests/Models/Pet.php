<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $age
 * @property string $last_visit
 * @property int $species_id
 * @property int $breed_id
 * @property Species $species
 * @property Breed $breed
 */
class Pet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pets';

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
        'age',
        'last_visit',
        'species_id',
        'breed_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Species
     */
    public function species()
    {
        return $this->belongsTo(Species::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Breed
     */
    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }
}
