<?php

namespace EFSill\Http\Controllers;

use EFSill\Supply;
use Illuminate\Http\Request;
use EFSill\Http\Controllers\Controller;

class SupplyController extends Controller {

	// GET /supplies/{width?}
	public function showList($width = 100)
	{
		return view('supplies', ['supplies' => Supply::byWidth($width)->get(), 'width' => $width]);
	}

	// GET /supply?width={width?}
	public function add(Request $request)
	{
		$supply = new Supply;
		$supply->width = $request->input('width');
		return view('supply', ['supply' => $supply]);
	}

	// GET /supply/{id}
	public function edit($id)
	{
		$supply = Supply::find($id);
		return view('supply', ['supply' => $supply]);
	}

	// DELETE /supply/{id}
	public function delete($id)
	{
		$supply = Supply::find($id);
		$supply->delete();
	}

	// POST /supply/{id}
	public function update(Request $request)
	{
		$this->validate($request, [
			'width' => 'required|integer',
			'length' => 'required|integer',
			'count' => 'required|integer',
		]);

		if ($request->input('id')) {
			$supply = Supply::find($request->input('id'));
			$supply->count = $request->input('count');
		} else {
			// При добавлении новой позиции ищем существующую с такими же параметрами
			$supply = Supply::firstOrCreate([
				'width' => $request->input('width'),
				'color' => $request->input('color'),
				'length' => $request->input('length'),
			]);
			$supply->width = $request->input('width');
			$supply->length = $request->input('length');
			$supply->color = $request->input('color');
			$supply->count += $request->input('count');
		}

		$supply->save();
		return redirect('/supplies/' . $supply->width);
	}

	// GET /export/supplies
	public function export()
	{
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Запасы ' . date('Y-m-d H:i:s') . '.xlsx"');
		header('Cache-Control: max-age=0');

		$supplies = Supply::where('count', '>', 0)->
							orderBy('width', 'asc')->
							orderBy('count', 'desc')->get();
		Supply::export($supplies);
	}
}
