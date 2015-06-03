<?php

namespace EFSill;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	protected $table = 'products';

	public function scopeNeededTypes($query)
	{
		return $query->distinct()->select(array('width', 'color'))->where('status', '0');
	}

	public function scopeByType($query, $productType)
	{
		return $query->where('width', $productType->width)
					->where('color', $productType->color)
					->where('status', 0)
					->orderBy('length', 'desc');
	}

	public function order()
	{
		return $this->belongsTo('EFSill\Order');
	}
}