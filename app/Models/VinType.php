<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VinType
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Vehicle[] $vehicles
 *
 * @package App\Models
 */
class VinType extends Model
{
	protected $table = 'vin_types';

	protected $fillable = [
		'name'
	];

	public function vehicles()
	{
		return $this->hasMany(Vehicle::class, 'vin_types_id');
	}
}
