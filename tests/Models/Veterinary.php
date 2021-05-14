<?php


namespace Rappasoft\LaravelLivewireTables\Tests\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Veterinary extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'veterinaries';

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
        'phone',
    ];

    public function pets(): BelongsToMany{
        return $this->belongsToMany(Pet::class);
    }
}
