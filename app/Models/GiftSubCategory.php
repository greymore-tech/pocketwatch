<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftSubCategory
 * 
 * @property int $id
 * @property int $gift_campaign_id
 * @property int $gift_category_id
 * @property string $name
 * @property string $validity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property GiftCampaign $gift_campaign
 * @property GiftCategory $gift_category
 *
 * @package App\Models
 */
class GiftSubCategory extends Model
{
	protected $table = 'gift_sub_categories';

	protected $casts = [
		'gift_campaign_id' => 'int',
		'gift_category_id' => 'int'
	];

	protected $fillable = [
		'gift_campaign_id',
		'gift_category_id',
		'name',
		'validity'
	];

	public function gift_campaign()
	{
		return $this->belongsTo(GiftCampaign::class);
	}

	public function gift_category()
	{
		return $this->belongsTo(GiftCategory::class);
	}
}
