<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
 * 
 * @property Collection|Vehicle[] $vehicles
 *
 * @package App\Models
 */
class Customer extends Model
{
	use HasFactory;
	protected $table = 'customers';

	protected $fillable = [
		'full_name',
		'avatar',
		'email',
		'phone',
		'residence_info'
	];

	public function vehicles()
	{
		return $this->hasMany(Vehicle::class);
	}
}
