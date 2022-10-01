<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GiftCampaign
 * 
 * @property int $id
 * @property string $short_code
 * @property string $branch_code
 * @property string $company_code
 * @property string $name
 * @property string $criteria
 * @property int $campaign_id
 * @property Carbon|null $start_date
 * @property Carbon|null $end_date
 * @property string $status
 * @property string|null $note
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MasterBranch $master_branch
 * @property MasterCampaign $master_campaign
 * @property MasterCompany $master_company
 * @property User $user
 * @property Collection|GiftAllotment[] $gift_allotments
 * @property Collection|GiftCategory[] $gift_categories
 * @property Collection|GiftRegistration[] $gift_registrations
 * @property Collection|GiftRule[] $gift_rules
 * @property Collection|GiftSubCategory[] $gift_sub_categories
 *
 * @package App\Models
 */
class GiftCampaign extends Model
{
	protected $table = 'gift_campaigns';

	protected $casts = [
		'campaign_id' => 'int',
		'created_by' => 'int',
		'updated_by' => 'int'
	];

	protected $dates = [
		'start_date',
		'end_date'
	];

	protected $fillable = [
		'short_code',
		'branch_code',
		'company_code',
		'name',
		'criteria',
		'campaign_id',
		'start_date',
		'end_date',
		'status',
		'note',
		'created_by',
		'updated_by'
	];

	public function master_branch()
	{
		return $this->belongsTo(MasterBranch::class, 'branch_code', 'branch_code');
	}

	public function master_campaign()
	{
		return $this->belongsTo(MasterCampaign::class, 'campaign_id');
	}

	public function master_company()
	{
		return $this->belongsTo(MasterCompany::class, 'company_code', 'code');
	}

	public function created_by()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
	
	public function updated_by()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function gift_allotments()
	{
		return $this->hasMany(GiftAllotment::class);
	}

	public function gift_categories()
	{
		return $this->hasMany(GiftCategory::class);
	}

	public function gift_registrations()
	{
		return $this->hasMany(GiftRegistration::class);
	}

	public function gift_rules()
	{
		return $this->hasMany(GiftRule::class);
	}

	public function gift_sub_categories()
	{
		return $this->hasMany(GiftSubCategory::class);
	}
}
