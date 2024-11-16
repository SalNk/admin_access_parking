<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehicle
 * 
 * @property int $id
 * @property int $customer_id
 * @property string $vin
 * @property string $color
 * @property string|null $transmission
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $brand_vehicles_id
 * @property int $model_vehicles_id
 * @property int $vin_types_id
 * 
 * @property BrandVehicle $brand_vehicle
 * @property Customer $customer
 * @property ModelVehicle $model_vehicle
 * @property VinType $vin_type
 *
 * @package App\Models
 */
class Vehicle extends Model
{
	protected $table = 'vehicles';

	protected $casts = [
		'customer_id' => 'int',
		'brand_vehicles_id' => 'int',
		'model_vehicles_id' => 'int',
		'vin_types_id' => 'int'
	];

	protected $fillable = [
		'customer_id',
		'vin',
		'color',
		'transmission',
		'description',
		'brand_vehicles_id',
		'model_vehicles_id',
		'vin_types_id'
	];

	public function brand_vehicle()
	{
		return $this->belongsTo(BrandVehicle::class, 'brand_vehicles_id');
	}

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function model_vehicle()
	{
		return $this->belongsTo(ModelVehicle::class, 'model_vehicles_id');
	}

	public function vin_type()
	{
		return $this->belongsTo(VinType::class, 'vin_types_id');
	}
}
