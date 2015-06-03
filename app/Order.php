<?php

namespace EFSill;

use Illuminate\Database\Eloquent\Model;
use EFSill\Product;

class Order extends Model {
	protected $table = 'orders';

	public function products()
    {
        return $this->hasMany('EFSill\Product');
    }

    // Пример файла импорта находится в /data/868.xlsx
    public static function import($filePath)
    {
    	$objPHPExcel = \PHPExcel_IOFactory::load($filePath);
		$sheet = $objPHPExcel->getSheet();
		$order = new Order();
		$order->order_number = intval($sheet->getCellByColumnAndRow(2, 1)->getValue());
		$order->client_name = $sheet->getCellByColumnAndRow(3, 2)->getValue();
		$order->oracle_number = intval($sheet->getCellByColumnAndRow(7, 2)->getValue());

		$row = 3;
		while ($sheet->getCellByColumnAndRow(0, $row)->getValue() != 1) {
		    $row++;
		}

		$products = array();
		while ($sheet->getCellByColumnAndRow(1, $row)->getValue() != '') {
		    for ($i = 0, $count = $sheet->getCellByColumnAndRow(3, $row)->getValue(); $i < $count; $i++) {
		        $product = new Product;
		        $product->width = $sheet->getCellByColumnAndRow(1, $row)->getValue();
		        $product->length = $sheet->getCellByColumnAndRow(2, $row)->getValue();
		        $product->color = 0;
		        if (strpos(strtolower($sheet->getCellByColumnAndRow(4, $row)->getValue()), 'зол')) {
		            $product->color = 1;
		        }
		        $product->note = $sheet->getCellByColumnAndRow(6, $row)->getValue();
		        array_push($products, $product);
		    }
		    $row++;
		}

		$order->save();
		$order->products()->saveMany($products);
    }

}