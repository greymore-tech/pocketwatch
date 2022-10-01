<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftCouponExclusion
 * 
 * @property int $id
 * @property int $campaign_id
 * @property string|null $excluded_brand
 * @property string|null $excluded_model
 * @property string|null $excluded_category
 * @property string|null $excluded_item_code
 * @property string $validity
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterGiftCouponCampaign $master_gift_coupon_campaign
 * @property User $user
 *
 * @package App\Models
 */
class GiftCouponExclusion extends Model
{
	protected $table = 'gift_coupon_exclusions';

	protected $casts = [
		'campaign_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'campaign_id',
		'excluded_brand',
		'excluded_model',
		'excluded_category',
		'excluded_item_code',
		'validity',
		'created_by'
	];

	public function master_gift_coupon_campaign()
	{
		return $this->belongsTo(MasterGiftCouponCampaign::class, 'campaign_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
