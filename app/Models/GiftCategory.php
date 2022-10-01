<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftCategory
 * 
 * @property int $id
 * @property int $gift_campaign_id
 * @property string $name
 * @property string $validity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property GiftCampaign $gift_campaign
 * @property Collection|GiftSubCategory[] $gift_sub_categories
 *
 * @package App\Models
 */
class GiftCategory extends Model
{
	protected $table = 'gift_categories';

	protected $casts = [
		'gift_campaign_id' => 'int'
	];

	protected $fillable = [
		'gift_campaign_id',
		'name',
		'validity'
	];

	public function gift_campaign()
	{
		return $this->belongsTo(GiftCampaign::class);
	}

	public function gift_sub_categories()
	{
		return $this->hasMany(GiftSubCategory::class);
	}
}
