<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pets';

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
        'sort',
        'name',
        'age',
        'last_visit',
        'species_id',
        'breed_id',
    ];

    protected $casts = [
        'last_visit' => 'datetime:Y-m-d',
    ];

    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function veterinaries(): BelongsToMany
    {
        return $this->belongsToMany(Veterinary::class);
    }
}
