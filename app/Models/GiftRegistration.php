<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftRegistration
 * 
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $phone_otp
 * @property bool $phone_verified
 * @property string $email
 * @property string $email_otp
 * @property bool $email_verified
 * @property string|null $category
 * @property string|null $product
 * @property string|null $division
 * @property string|null $itemcode
 * @property float|null $amount
 * @property int $campaign_id
 * @property int $gift_campaign_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterCampaign $master_campaign
 * @property GiftCampaign $gift_campaign
 * @property Collection|GiftAllotment[] $gift_allotments
 *
 * @package App\Models
 */
class GiftRegistration extends Model
{
	protected $table = 'gift_registrations';

	protected $casts = [
		'phone_verified' => 'bool',
		'email_verified' => 'bool',
		'amount' => 'float',
		'campaign_id' => 'int',
		'gift_campaign_id' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'phone',
		'phone_otp',
		'phone_verified',
		'email',
		'email_otp',
		'email_verified',
		'category',
		'product',
		'division',
		'itemcode',
		'amount',
		'campaign_id',
		'gift_campaign_id'
	];

	public function master_campaign()
	{
		return $this->belongsTo(MasterCampaign::class, 'campaign_id');
	}

	public function gift_campaign()
	{
		return $this->belongsTo(GiftCampaign::class);
	}

	public function gift_allotments()
	{
		return $this->hasMany(GiftAllotment::class);
	}
}
