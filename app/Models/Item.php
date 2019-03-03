<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 03 Mar 2019 17:48:50 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Item
 * 
 * @property int $id
 * @property string $name
 * @property int $type_id
 * 
 * @property \App\Models\ItemType $item_type
 *
 * @package App\Models
 */
class Item extends Eloquent
{
	protected $table = 'item';
	public $timestamps = false;

	protected $casts = [
		'type_id' => 'int'
	];

	protected $fillable = [
		'name',
		'type_id'
	];

	public function item_type()
	{
		return $this->belongsTo(\App\Models\ItemType::class, 'type_id');
	}
}
