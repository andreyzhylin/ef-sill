<?php

namespace EFSill\Http\Controllers;

use EFSill\Task;
use EFSill\Product;

use Illuminate\Http\Request;
use EFSill\Http\Controllers\Controller;

class TaskController extends Controller {

	// GET /task
	public function next()
	{
		$task = Task::getNext();

		// Если оптимальное решение не найдено, то ждем пополнения запасов
		if (!isset($task->supply)) {
			return view('task', ['message' => 'На данный момент задач нет']);
		}

		return view('task', ['supply' => $task->supply, 'products' => $task->products, 'newSupply' => $task->newSupply]);
	}

	// POST /task/complete
	public function complete(Request $request)
	{
		$supplyId = $request->input('supplyId');
		$newSupplyLength = $request->input('newSupplyLength');
		$productIds = $request->input('productIds');

		Task::complete($supplyId, $newSupplyLength, $productIds);

		return redirect('/task/');
	}

	// GET /history
	public function history()
	{
		$products = Product::where('status', 1)->orderBy('completed_at', 'desc')->paginate(10);
		return view('history', ['products' => $products]);
	}

}