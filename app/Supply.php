<?php

namespace EFSill;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model {
	protected $table = 'supplies';
	protected $fillable = array('length');
	const MAX_WASTE_LENGTH = 150;
	const MIN_SUPPLY_LENGTH = 800;

	public function scopeByWidth($query, $width)
    {
        return $query->where('width', $width)
        			->where('count', '>', 0)
        			->orderBy('color', 'asc')
        			->orderBy('count', 'desc')
        			->orderBy('length', 'desc');
    }

    public function scopeByType($query, $productType)
    {
        return $query->where('width', $productType->width)
        			->where('color', $productType->color)
        			->where('count', '>', 0)
        			->orderBy('length', 'asc');
    }

    public static function export($supplies)
    {
        $excel = new \PHPExcel;
        $excelWriter = \PHPExcel_IOFactory::createWriter($excel, "Excel2007");
        $excelSheet = $excel->getActiveSheet();
        $excelSheet->setTitle('Запасы на складе');
        $excelSheet->getCell('A1')->setValue('Ширина');
        $excelSheet->getCell('B1')->setValue('Длина');
        $excelSheet->getCell('C1')->setValue('Цвет');
        $excelSheet->getCell('D1')->setValue('Кол-во');

        $i = 2;
        foreach ($supplies as $supply) {
            $excelSheet->getCell("A$i")->setValue($supply->width);
            $excelSheet->getCell("B$i")->setValue($supply->length);
            $color = $supply->color == 0 ? 'Белый' : 'Золото';
            $excelSheet->getCell("C$i")->setValue($color);
            $excelSheet->getCell("D$i")->setValue($supply->count);
            $i++;
        }
        $excelWriter->save('php://output');
    }

}