<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * 
 * @property Customer $customer
 *
 * @package App\Models
 */
class Vehicle extends Model
{
	use HasFactory;
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
		'description'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}
}
