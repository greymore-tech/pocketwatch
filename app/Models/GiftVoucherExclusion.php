<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftVoucherExclusion
 * 
 * @property int $id
 * @property int $campaign_id
 * @property string|null $excluded_brand
 * @property string|null $excluded_model
 * @property string|null $excluded_category
 * @property int $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterGiftVoucherCampaign $master_gift_voucher_campaign
 * @property User $user
 *
 * @package App\Models
 */
class GiftVoucherExclusion extends Model
{
	protected $table = 'gift_voucher_exclusions';

	protected $casts = [
		'campaign_id' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'campaign_id',
		'excluded_brand',
		'excluded_model',
		'excluded_category',
		'created_by'
	];

	public function master_gift_voucher_campaign()
	{
		return $this->belongsTo(MasterGiftVoucherCampaign::class, 'campaign_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
