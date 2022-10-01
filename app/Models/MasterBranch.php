<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterBranch
 * 
 * @property int $id
 * @property string $company_code
 * @property string|null $zone
 * @property string|null $district
 * @property string|null $location_name
 * @property string $address_line_1
 * @property string|null $address_line_2
 * @property string|null $address_line_3
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string|null $pincode
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $alt_phone
 * @property string $branch
 * @property string $branch_code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|BranchAccount[] $branch_accounts
 * @property Collection|BuybackItem[] $buyback_items
 * @property Collection|CollectedPayment[] $collected_payments
 * @property Collection|CouponCampaign[] $coupon_campaigns
 * @property Collection|CreditRequest[] $credit_requests
 * @property Collection|Delivery[] $deliveries
 * @property Collection|DeliveryPartner[] $delivery_partners
 * @property Collection|DeliveryTrip[] $delivery_trips
 * @property Collection|DraftOrderItem[] $draft_order_items
 * @property Collection|DraftOrder[] $draft_orders
 * @property Collection|Einvoice[] $einvoices
 * @property Collection|Ewaybill[] $ewaybills
 * @property Collection|ExpenseRequest[] $expense_requests
 * @property Collection|Gatepass[] $gatepasses
 * @property Collection|GiftCampaign[] $gift_campaigns
 * @property Collection|InformalExpense[] $informal_expenses
 * @property Collection|MasterDiscountRequest[] $master_discount_requests
 * @property Collection|MasterEmployee[] $master_employees
 * @property Collection|MasterGiftCouponCampaign[] $master_gift_coupon_campaigns
 * @property Collection|MasterOffer[] $master_offers
 * @property Collection|MasterWarehouse[] $master_warehouses
 * @property Collection|OrderItem[] $order_items
 * @property Collection|Order[] $orders
 * @property Collection|PastDelivery[] $past_deliveries
 * @property Collection|PriceLockHistory[] $price_lock_histories
 * @property Collection|PriceLock[] $price_locks
 * @property Collection|Receipt[] $receipts
 * @property Collection|ServingBranch[] $serving_branches
 * @property Collection|StockTransferRequest[] $stock_transfer_requests
 * @property Collection|ZoneBranch[] $zone_branches
 *
 * @package App\Models
 */
class MasterBranch extends Model
{
	protected $table = 'master_branches';

	protected $fillable = [
		'company_code',
		'zone',
		'district',
		'location_name',
		'address_line_1',
		'address_line_2',
		'address_line_3',
		'city',
		'state',
		'country',
		'pincode',
		'email',
		'phone',
		'alt_phone',
		'branch',
		'branch_code',
		'latitude',
		'longitude'
	];
	protected $appends = ['fullname'];
	
	public function getFullnameAttribute()
	{
		return "{$this->branch} - {$this->branch_code} - {$this->company_code}";
	}
	public function branch_accounts()
	{
		return $this->hasMany(BranchAccount::class, 'branch', 'branch_code');
	}

	public function buyback_items()
	{
		return $this->hasMany(BuybackItem::class, 'branch_code', 'branch_code');
	}

	public function collected_payments()
	{
		return $this->hasMany(CollectedPayment::class, 'branch_code', 'branch_code');
	}

	public function coupon_campaigns()
	{
		return $this->hasMany(CouponCampaign::class, 'branch_code', 'branch_code');
	}

	public function credit_requests()
	{
		return $this->hasMany(CreditRequest::class, 'branch_code', 'branch_code');
	}

	public function deliveries()
	{
		return $this->hasMany(Delivery::class, 'branch_code', 'branch_code');
	}

	public function delivery_partners()
	{
		return $this->hasMany(DeliveryPartner::class, 'branch_code', 'branch_code');
	}

	public function delivery_trips()
	{
		return $this->hasMany(DeliveryTrip::class, 'branch_code', 'branch_code');
	}

	public function draft_order_items()
	{
		return $this->hasMany(DraftOrderItem::class, 'branch', 'branch_code');
	}

	public function draft_orders()
	{
		return $this->hasMany(DraftOrder::class, 'branch_code', 'branch_code');
	}

	public function einvoices()
	{
		return $this->hasMany(Einvoice::class, 'branch_code', 'branch_code');
	}

	public function ewaybills()
	{
		return $this->hasMany(Ewaybill::class, 'branch_code', 'branch_code');
	}

	public function expense_requests()
	{
		return $this->hasMany(ExpenseRequest::class, 'branch_code', 'branch_code');
	}

	public function gatepasses()
	{
		return $this->hasMany(Gatepass::class, 'branch_code', 'branch_code');
	}

	public function gift_campaigns()
	{
		return $this->hasMany(GiftCampaign::class, 'branch_code', 'branch_code');
	}

	public function informal_expenses()
	{
		return $this->hasMany(InformalExpense::class, 'branch_code', 'branch_code');
	}

	public function master_discount_requests()
	{
		return $this->hasMany(MasterDiscountRequest::class, 'branch_code', 'branch_code');
	}

	public function master_employees()
	{
		return $this->hasMany(MasterEmployee::class, 'branch_code', 'branch_code');
	}

	public function master_gift_coupon_campaigns()
	{
		return $this->hasMany(MasterGiftCouponCampaign::class, 'branch_code', 'branch_code');
	}

	public function master_offers()
	{
		return $this->hasMany(MasterOffer::class, 'branch_code', 'branch_code');
	}

	public function master_warehouses()
	{
		return $this->hasMany(MasterWarehouse::class, 'branch', 'branch_code');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class, 'branch', 'branch_code');
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'branch_code', 'branch_code');
	}

	public function past_deliveries()
	{
		return $this->hasMany(PastDelivery::class, 'branch_code', 'branch_code');
	}

	public function price_lock_histories()
	{
		return $this->hasMany(PriceLockHistory::class, 'branch_code', 'branch_code');
	}

	public function price_locks()
	{
		return $this->hasMany(PriceLock::class, 'branch_code', 'branch_code');
	}

	public function receipts()
	{
		return $this->hasMany(Receipt::class, 'branch_code', 'branch_code');
	}

	public function serving_branches()
	{
		return $this->hasMany(ServingBranch::class, 'inventory_source', 'branch_code');
	}

	public function stock_transfer_requests()
	{
		return $this->hasMany(StockTransferRequest::class, 'source_branch', 'branch_code');
	}

	public function zone_branches()
	{
		return $this->hasMany(ZoneBranch::class, 'branch_code', 'branch_code');
	}
}
