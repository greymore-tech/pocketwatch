<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftCouponRule
 * 
 * @property int $id
 * @property int $campaign_id
 * @property float $order_value_1
 * @property float $order_value_0
 * @property float $voucher_value
 * @property string $validity
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterGiftCouponCampaign $master_gift_coupon_campaign
 * @property User $user
 *
 * @package App\Models
 */
class GiftCouponRule extends Model
{
	protected $table = 'gift_coupon_rules';

	protected $casts = [
		'campaign_id' => 'int',
		'order_value_1' => 'float',
		'order_value_0' => 'float',
		'voucher_value' => 'float',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'campaign_id',
		'order_value_1',
		'order_value_0',
		'voucher_value',
		'validity',
		'created_by',
		'updated_by'
	];

	public function master_gift_coupon_campaign()
	{
		return $this->belongsTo(MasterGiftCouponCampaign::class, 'campaign_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}
}
