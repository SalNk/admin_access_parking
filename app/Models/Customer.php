<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 * 
 * @property int $id
 * @property string $full_name
 * @property string|null $avatar
 * @property string|null $email
 * @property string $phone
 * @property string $residence_info
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $qrcode
 * 
 * @property Collection|Vehicle[] $vehicles
 *
 * @package App\Models
 */
class Customer extends Model
{
	protected $table = 'customers';

	protected $fillable = [
		'full_name',
		'avatar',
		'email',
		'phone',
		'residence_info',
		'qrcode'
	];

	public function vehicles()
	{
		return $this->hasMany(Vehicle::class);
	}
}
