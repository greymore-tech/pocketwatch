<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftRule
 * 
 * @property int $id
 * @property string|null $category
 * @property string|null $product
 * @property string|null $division
 * @property string|null $itemcode
 * @property string|null $lower_price_limit
 * @property string|null $upper_price_limit
 * @property string $assigned_gift
 * @property int $available_quantity
 * @property int $alloted_quantity
 * @property int $remaining_quantity
 * @property int $campaign_id
 * @property int $gift_campaign_id
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterCampaign $master_campaign
 * @property User $user
 * @property GiftCampaign $gift_campaign
 * @property Collection|GiftAllotment[] $gift_allotments
 *
 * @package App\Models
 */
class GiftRule extends Model
{
	protected $table = 'gift_rules';

	protected $casts = [
		'available_quantity' => 'int',
		'alloted_quantity' => 'int',
		'remaining_quantity' => 'int',
		'campaign_id' => 'int',
		'gift_campaign_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'category',
		'product',
		'division',
		'itemcode',
		'lower_price_limit',
		'upper_price_limit',
		'assigned_gift',
		'available_quantity',
		'alloted_quantity',
		'remaining_quantity',
		'campaign_id',
		'gift_campaign_id',
		'created_by',
		'updated_by'
	];

	public function master_campaign()
	{
		return $this->belongsTo(MasterCampaign::class, 'campaign_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function gift_campaign()
	{
		return $this->belongsTo(GiftCampaign::class);
	}

	public function gift_allotments()
	{
		return $this->hasMany(GiftAllotment::class, 'satisfied_gift_rule_id');
	}
}
