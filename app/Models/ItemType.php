<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 17:48:50 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ItemType
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $items
 *
 * @package App\Models
 */
class ItemType extends Eloquent
{
	protected $table = 'item_type';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function items()
	{
		return $this->hasMany(\App\Models\Item::class, 'type_id');
	}
}
