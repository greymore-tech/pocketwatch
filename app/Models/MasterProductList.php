<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MasterProductList
 * 
 * @property int $id
 * @property string $company_id
 * @property string $product_code
 * @property string $product_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class MasterProductList extends Model
{
	protected $table = 'master_product_lists';

	protected $fillable = [
		'company_id',
		'product_code',
		'product_name'
	];
}
