<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehicle
 * 
 * @property int $id
 * @property int $customer_id
 * @property string $model
 * @property string $vin
 * @property string $color
 * @property string|null $transmission
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $brand
 * @property string $vin_type
 * 
 * @property Customer $customer
 * @property Collection|ParkingAccess[] $parking_accesses
 *
 * @package App\Models
 */
class Vehicle extends Model
{
	protected $table = 'vehicles';

	protected $casts = [
		'customer_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'model',
		'vin',
		'color',
		'transmission',
		'description',
		'brand',
		'vin_type'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function parking_accesses()
	{
		return $this->hasMany(ParkingAccess::class);
	}
}
