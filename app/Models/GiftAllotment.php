<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftAllotment
 * 
 * @property int $id
 * @property string $phone
 * @property int $satisfied_gift_rule_id
 * @property bool $given_to_customer
 * @property int $gift_registration_id
 * @property int $gift_campaign_id
 * @property int $campaign_id
 * @property int $gatepass_id
 * @property int $created_by
 * @property int $updated_by
 * @property string $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterCampaign $master_campaign
 * @property User $user
 * @property Gatepass $gatepass
 * @property GiftCampaign $gift_campaign
 * @property GiftRegistration $gift_registration
 * @property GiftRule $gift_rule
 *
 * @package App\Models
 */
class GiftAllotment extends Model
{
	protected $table = 'gift_allotments';

	protected $casts = [
		'satisfied_gift_rule_id' => 'int',
		'given_to_customer' => 'bool',
		'gift_registration_id' => 'int',
		'gift_campaign_id' => 'int',
		'campaign_id' => 'int',
		'gatepass_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $fillable = [
		'phone',
		'satisfied_gift_rule_id',
		'given_to_customer',
		'gift_registration_id',
		'gift_campaign_id',
		'campaign_id',
		'gatepass_id',
		'created_by',
		'updated_by',
		'notes'
	];

	public function master_campaign()
	{
		return $this->belongsTo(MasterCampaign::class, 'campaign_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function gatepass()
	{
		return $this->belongsTo(Gatepass::class);
	}

	public function gift_campaign()
	{
		return $this->belongsTo(GiftCampaign::class);
	}

	public function gift_registration()
	{
		return $this->belongsTo(GiftRegistration::class);
	}

	public function gift_rule()
	{
		return $this->belongsTo(GiftRule::class, 'satisfied_gift_rule_id');
	}
}
