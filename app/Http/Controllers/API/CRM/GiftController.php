<?php

namespace App\Http\Controllers\API\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGiftCampaignRequest;
use App\Http\Requests\GiftCampaignRuleRequest;
use App\Http\Requests\GiftRegisterRequest;
use App\Services\GiftService;
use App\Models\MasterProductList;

class GiftController extends Controller
{
    protected $gift;
    
    public function __construct(GiftService $service)
    {
    	$this->gift = $service;
    }
    
    public function createCampaign(CreateGiftCampaignRequest $request)
    {
    	$validated = $request->validated();
    	$this->gift->createCampaign($validated['short_code'], $validated['branch_code'], $validated['company_code'], $validated['name'], $validated['criteria'], $validated['campaign_id'], $validated['start_date'], $validated['end_date'], $validated['notes']);
    }
    
    public function indexCampaigns(Request $request)
    {
    	return $this->gift->index($request->all());
    }
    
    public function showCampaign(Request $request)
    {
    	return $this->gift->showCampaign($request->get('id'));
    }
    
    public function addCampaignRule(GiftCampaignRuleRequest $request)
    {
    	$validated = $request->validated();
    	$this->gift->addCampaignRule($validated['campaign'], $validated['category'], $validated['product'], $validated['division'], (array_key_exists('item_code', $validated))?$validated['item_code']:null, (array_key_exists('lower_limit', $validated))?$validated['lower_limit']:null, (array_key_exists('upper_limit', $validated))?$validated['upper_limit']:null, $validated['assigned_gift'], $validated['alloted_quantity']);
    }
    
    public function getCampaignRules(Request $request)
    {
    	return $this->gift->getCampaignRules($request->all());
    }
    
    public function getCampaignRegistrations(Request $request)
    {
    	return $this->gift->getCampaignRegistrations($request->all());
    }
    
    public function registrationPage($shortcode)
    {
    	$campaign = $this->gift->shortCodeReturn($shortcode);
    	if($campaign != null)
    		$categories = $this->gift->getGiftCategories($campaign->id);
    	else
    		$categories = null;
    	return view('gift-registration', ["campaign" => $campaign, "categories" => $categories, "products" => MasterProductList::all()]);
    }
    
    public function giftRegister(GiftRegisterRequest $request)
    {
    	$status = $this->gift->giftRegister($request->get('id'), $request->get('first_name'), $request->get('last_name'), $request->get('phone'), $request->get('email'), $request->get('category'), $request->get('product'), $request->get('division'), $request->get('itemcode'), $request->get('amount'));
    	if($status['status'] != null){
    		if($status['status'] == 0 || $status['status'] == 1){
    			$dpstatus = "Failed";
					$message = "Better luck next time";
					$gift = null;
					$registration = null;
    		}
    		else{
    			$dpstatus = "Success";
					$message = "Congrats! You've won a gift.";
					$gift = $status['gift'];
					$registration = $status['registration'];
    		}
    	}
    	else{
    		$dpstatus = "Failed";
				$message = "Better luck next time";
				$gift = null;
				$registration = null;
    	}
    	
    	return redirect()->route('scratchcard', ['shortcode' => $status['short_code']])->with([
    		'dpstatus' => $dpstatus,
    		'message' => $message,
    		'gift' => $gift,
    		'registration' => $registration
    	]);
    }
    
    public function getGiftCategories(Request $request)
    {
    	return $this->gift->getGiftCategories($request->get('campaign'));
    }
    
    public function getGiftSubCategories(Request $request)
    {
    	return $this->gift->getGiftSubCategories($request->get('campaign'), $request->get('category'));
    }
    
    public function addGiftCategory(Request $request)
    {
    	$this->validate($request, [
    		'campaign' => ['required', 'numeric'],
    		'name' => ['required', 'string']
    	]);
    	$this->gift->addGiftCategory($request->get('campaign'), $request->get('name'));
    }
    
    public function addGiftSubCategory(Request $request)
    {
    	$this->validate($request, [
    		'campaign' => ['required', 'numeric'],
    		'name' => ['required', 'string'],
    		'category' => ['required', 'numeric']
    	]);
    	$this->gift->addGiftSubCategory($request->get('campaign'), $request->get('category'), $request->get('name'));
    }
    
    public function changeGiftCategory(Request $request)
    {
    	$this->gift->changeGiftCategory($request->get('id'));
    }
    
    public function changeGiftSubCategory(Request $request)
    {
    	$this->gift->changeGiftSubCategory($request->get('id'));
    }
    
    public function getGiftAllotments(Request $request)
    {
    	return $this->gift->getGiftAllotments($request->all());
    }
    
    public function giftGiven(Request $request)
    {
    	$this->gift->giftGivenToCustomer($request->get('id'), $request->get('notes'));
    }
}
