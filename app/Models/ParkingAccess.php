<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ParkingAccess
 * 
 * @property int $id
 * @property int $customer_id
 * @property int $vehicle_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon $entry_time
 * @property Carbon|null $exit_time
 * @property string $qrcode
 * @property string $status
 * 
 * @property Customer $customer
 * @property Vehicle $vehicle
 *
 * @package App\Models
 */
class ParkingAccess extends Model
{
	protected $table = 'parking_accesses';

	protected $casts = [
		'customer_id' => 'int',
		'vehicle_id' => 'int',
		'entry_time' => 'datetime',
		'exit_time' => 'datetime'
	];

	protected $fillable = [
		'customer_id',
		'vehicle_id',
		'entry_time',
		'exit_time',
		'qrcode',
		'status'
	];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

	public function vehicle()
	{
		return $this->belongsTo(Vehicle::class);
	}
}
