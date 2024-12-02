<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use App\Utils\GenerateQrCode;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Collection;

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
class Vehicle extends Model implements HasMedia
{
	use InteractsWithMedia;

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

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('vehicle-images');
	}

	protected static function booted()
	{
		static::saved(callback: function ($vehicle) {


			if ($vehicle->customer_id) {
				$customer = Customer::findOrFail($vehicle->customer_id);
				// dd($customer);

				$formatData =
					'Modele du vehicule : ' . $vehicle->model .
					' - Matricule : ' . $vehicle->vin .
					' - Couleur : ' . $vehicle->color .
					' - Nom du client : ' . $customer->full_name;

				$qrcode = GenerateQrCode::generateSvg($formatData);

				$customer['qrcode'] = $qrcode;
				$customer->save();
			}
		});
	}

}
