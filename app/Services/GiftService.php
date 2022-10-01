<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterBranch;
use App\Models\GiftCampaign;
use App\Models\GiftRule;
use App\Models\GiftRegistration;
use App\Models\GiftCategory;
use App\Models\GiftSubCategory;
use App\Models\GiftAllotment;

class GiftService
{
	public function createCampaign($short_code, $branch_code, $company_code, $name, $criteria, $campaign_id, $start_date, $end_date, $notes)
	{
		GiftCampaign::create([
			'short_code' => $short_code,
			'branch_code' => $branch_code,
			'company_code' => $company_code,
			'name' => $name,
			'criteria' => $criteria,
			'campaign_id' => $campaign_id,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'note' => $notes,
			'created_by' => Auth::id(),
			'updated_by' => Auth::id()
		]);
	}
	
	public function index(array $filters)
	{
		$query = GiftCampaign::select('*')->with('master_campaign')->orderBy('id', 'DESC');
		
		return ["data" => $query->paginate()];
	}
	
	public function showCampaign($id)
	{
		return GiftCampaign::where('id', $id)->with(['master_campaign', 'created_by', 'updated_by'])->first();
	}
	
	public function shortCodeReturn($shortcode)
	{
		return GiftCampaign::where('short_code', $shortcode)->first();
	}
	
	public function addCampaignRule($id, $category, $product, $division, $itemcode, $lowerlimit, $upperlimit, $assigned_gift, $alloted_quantity)
	{
		$campaign = GiftCampaign::where('id', $id)->first();
		
		GiftRule::create([
			'category' => $category,
			'product' => $product,
			'division' => $division,
			'itemcode' => $itemcode,
			'lower_price_limit' => $lowerlimit,
			'upper_price_limit' => $upperlimit,
			'assigned_gift' => $assigned_gift,
			'available_quantity' => $alloted_quantity,
			'alloted_quantity' => 0,
			'remaining_quantity' => $alloted_quantity,
			'campaign_id' => $campaign->campaign_id,
			'gift_campaign_id' => $campaign->id,
			'created_by' => Auth::id(),
			'updated_by' => Auth::id()
		]);
	}
	
	public function getCampaignRules(array $filters)
	{
		$query = GiftRule::select('*')->where('gift_campaign_id', $filters['campaign'])->orderBy('id', 'DESC');
		
		$category = (array_key_exists('category', $filters))?$filters['category']:null;
		if($category != null && $category != ''){
				$query->where(function($query) use ($category) {
		   		$query->where(function($query) use ($category){
		    	  $query->where('category', $category);
		      });
		    });
		}
		$division = (array_key_exists('division', $filters))?$filters['division']:null;
		if($division != null && $division != ''){
				$query->where(function($query) use ($division) {
		   		$query->where(function($query) use ($division){
		    	  $query->where('division', $division);
		      });
		    });
		}
		$product = (array_key_exists('product', $filters))?$filters['product']:null;
		if($product != null && $product != ''){
				$query->where(function($query) use ($product) {
		   		$query->where(function($query) use ($product){
		    	  $query->where('product', $product);
		      });
		    });
		}
		$lower = (array_key_exists('lower', $filters))?$filters['lower']:null;
		if($lower != null && $lower != ''){
				$query->where(function($query) use ($lower) {
		   		$query->where(function($query) use ($lower){
		    	  $query->where('lower_price_limit', '>=', $lower);
		      });
		    });
		}
		$upper = (array_key_exists('upper', $filters))?$filters['upper']:null;
		if($upper != null && $upper != ''){
				$query->where(function($query) use ($upper) {
		   		$query->where(function($query) use ($upper){
		    	  $query->where('upper_price_limit', '>=', $upper);
		      });
		    });
		}
		
		return ["data" => $query->paginate()];
	}
	
	public function getCampaignRegistrations(array $filters)
	{
		$query = GiftRegistration::select('*')->where('gift_campaign_id', $filters['campaign'])->orderBy('id', 'DESC');
		
		$category = (array_key_exists('category', $filters))?$filters['category']:null;
		if($category != null && $category != ''){
				$query->where(function($query) use ($category) {
		   		$query->where(function($query) use ($category){
		    	  $query->where('category', $category);
		      });
		    });
		}
		$division = (array_key_exists('division', $filters))?$filters['division']:null;
		if($division != null && $division != ''){
				$query->where(function($query) use ($division) {
		   		$query->where(function($query) use ($division){
		    	  $query->where('division', $division);
		      });
		    });
		}
		$product = (array_key_exists('product', $filters))?$filters['product']:null;
		if($product != null && $product != ''){
				$query->where(function($query) use ($product) {
		   		$query->where(function($query) use ($product){
		    	  $query->where('product', $product);
		      });
		    });
		}	
		/*$criteria = (array_key_exists($filters, 'criteria'))?$filters['criteria']:null;
		if($criteria != null && $criteria != ''){
				$query->where(function($query) use ($criteria) {
		   		$query->where(function($query) use ($criteria){
		    	  $query->where('criteria', $criteria);
		      });
		    });
		}*/
		$itemcode = (array_key_exists('itemcode', $filters))?$filters['itemcode']:null;
		if($itemcode != null && $itemcode != ''){
				$query->where(function($query) use ($itemcode) {
		   		$query->where(function($query) use ($itemcode){
		    	  $query->where('itemcode', $itemcode);
		      });
		    });
		}
		$amount = (array_key_exists('amount', $filters))?$filters['amount']:null;
		if($amount != null && $amount != ''){
				$query->where(function($query) use ($amount) {
		   		$query->where(function($query) use ($amount){
		    	  $query->where('amount', $amount);
		      });
		    });
		}
		$phone = (array_key_exists('phone', $filters))?$filters['phone']:null;
		if($phone != null && $phone != ''){
				$query->where(function($query) use ($phone) {
		   		$query->where(function($query) use ($phone){
		    	  $query->where('phone', 'like', '%'.$phone.'%');
		      });
		    });
		}
		$from = (array_key_exists('from', $filters))?$filters['from']:null;
		if($from != null && $from != ''){
				$query->where(function($query) use ($from) {
		   		$query->where(function($query) use ($from){
		    	  $query->whereDate('created_at', '>=', $from);
		      });
		    });
		}
		$to = (array_key_exists('to', $filters))?$filters['to']:null;
		if($from != null && $to != ''){
				$query->where(function($query) use ($to) {
		   		$query->where(function($query) use ($to){
		    	  $query->whereDate('created_at', '<=', $to);
		      });
		    });
		}
		
		return ["data" => $query->paginate()];
	}
	
	public function giftRegister($id, $first_name, $last_name, $phone, $email, $category, $product, $division, $itemcode, $amount=null)
	{
		$campaign = GiftCampaign::where('id', $id)->first();
		$giftcategory = GiftCategory::where('id', $category)->first();
		$giftsubcategory = GiftSubCategory::where('id', $division)->first();
		
		if($campaign == null || $giftcategory == null || $giftsubcategory == null)
			return ['status' => null, 'short_code' => $campaign->short_code];
		else{
			$registration = GiftRegistration::where('phone', 'like', '%'.$phone.'%')->where('category', $giftcategory->name)->where('division', $giftsubcategory->name)->first();
			if($registration != null)
				return ['status' => 0, 'short_code' => $campaign->short_code];
				
			$registration = GiftRegistration::create([
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone' => $phone,
				'email' => $email,
				'category' => $giftcategory->name,
				'product' => $product,
				'division' => $giftsubcategory->name,
				'itemcode' => $itemcode,
				'amount' => $amount,
				'campaign_id' => $campaign->campaign_id,
				'gift_campaign_id' => $campaign->id
			]);
			
			if($campaign->criteria == 'CATEGORY'){
				$rule = GiftRule::where('category', $registration->category)->where('division', $registration->division)->first();
				
				if($rule != null && $rule->id != null && $rule->remaining_quantity > 0){
					$allotment = $this->allotGift($registration->phone, $rule->id, $registration->id, $campaign->id, $campaign->campaign_id);
					if($allotment->id != null){
						$rule->alloted_quantity = $rule->alloted_quantity + 1;
						$rule->remaining_quantity = $rule->remaining_quantity - 1;
						$rule->save();
						return ['status' => 200, "gift" => $rule->assigned_gift, 'registration' => $registration, 'short_code' => $campaign->short_code];
					}
				}
				else{
					return ['status' => 1, 'short_code' => $campaign->short_code];
				}
			}
		}
	}
	
	public function allotGift($phone, $rule, $registration, $gift_campaign, $campaign)
	{
		return GiftAllotment::create([
			'phone' => $phone,
			'satisfied_gift_rule_id' => $rule,
			'given_to_customer' => 0,
			'gift_registration_id' => $registration,
			'gift_campaign_id' => $gift_campaign,
			'campaign_id' => $campaign,
			'gatepass_id' => null,
			'created_by' => Auth::id(),
			'updated_by' => Auth::id(),
			'notes' => null
		]);
	}
	
	public function getGiftAllotments(array $filters)
	{
		$query = GiftAllotment::select('*')->with(['gift_registration:first_name,last_name,category,division', 'gift_rule:assigned_gift'])->where('gift_campaign_id', $filters['campaign'])->orderBy('id', 'DESC');
		
		$phone = (array_key_exists('phone', $filters))?$filters['phone']:null;
		if($phone != null && $phone != ''){
				$query->where(function($query) use ($phone) {
		   		$query->where(function($query) use ($phone){
		    	  $query->where('phone', 'like', '%'.$phone.'%');
		      });
		    });
		}
		
		return ["data" => $query->paginate()];
	}
	
	public function giftGivenToCustomer($id, $notes)
	{
		GiftAllotment::where('id', $id)->update([
			'given_to_customer' => 1,
			'notes' => $notes,
			'updated_by' => Auth::id()
		]);
	}
	
	public function getGiftCategories($campaign)
	{
		return GiftCategory::where('gift_campaign_id', $campaign)->where('validity', 'Active')->get();
	}
	
	public function getGiftSubCategories($campaign, $category=null)
	{
		return GiftSubCategory::where('gift_campaign_id', $campaign)->where('validity', 'Active')->when($category != null, function ($q) use ($category){
			return $q->where('gift_category_id', $category);
		})->with('gift_category')->get();
	}
	
	public function addGiftCategory($campaign, $name)
	{
		GiftCategory::create([
			'gift_campaign_id' => $campaign,
			'name' => $name
		]);
	}
	
	public function addGiftSubCategory($campaign, $category, $name)
	{
		GiftSubCategory::create([
			'gift_campaign_id' => $campaign,
			'gift_category_id' => $category,
			'name' => $name
		]);
	}
	
	public function changeGiftCategory($id)
	{
		$cat = GiftCategory::where('id', $id)->first();
		if($cat->validity == 'Active')
			$cat->validity = 'Inactive';
		else if($cat->validity == 'Inactive')
			$cat->validity = 'Active';
		$cat->save();
	}
	
	public function changeGiftSubCategory($id)
	{
		$cat = GiftSubCategory::where('id', $id)->first();
		if($cat->validity == 'Active')
			$cat->validity = 'Inactive';
		else if($cat->validity == 'Inactive')
			$cat->validity = 'Active';
		$cat->save();
	}
}

?>
