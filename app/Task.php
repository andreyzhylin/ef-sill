<?php

namespace EFSill;

use EFSill\Supply;
use EFSill\Order;
use EFSill\Product;

class Task {

	/**
	 * Описание проблемы http://en.wikipedia.org/wiki/Bin_packing_problem
	 * Для формирования задач используется алгоритм "Best fit decreasing"
	 * Дополнительно учитываются параметры "Минимальная допустимая длина подоконника" и
	 * "Максимально допустимая длина отходов"
	 */
	public static function getNext()
	{
		$neededTypes = Product::neededTypes()->get();
		$task = new \stdClass;
		foreach ($neededTypes as $neededType) {
			$products = Product::byType($neededType)->get();
			$supplies = Supply::byType($neededType)->get();
			$taskProducts = array();
			foreach ($supplies as $supply) {
				foreach ($products as $product) {
					if ($product->length <= $supply->length &&
						$supply->length - $product->length <= Supply::MAX_WASTE_LENGTH ||
						$supply->length - $product->length >= Supply::MIN_SUPPLY_LENGTH) {
						$supply->length -= $product->length;
						array_push($taskProducts, $product);
					}
				}
				if (count($taskProducts) != 0) {
					$task->supply = $supply;
					$task->products = $taskProducts;
					$task->newSupply = new Supply;
					$task->newSupply->width = $task->supply->width;
					$task->newSupply->color = $task->supply->color;
					$task->newSupply->length = $task->supply->length;
					foreach ($task->products as $product) {
						$task->supply->length += $product->length;
					}
					return $task;
				}
			}
		}
		return $task;
	}

	/**
	 * Завершить задачу резки
	 * @param  int $supplyId        ID запаса
	 * @param  int $newSupplyLength Результирующая длина остатка
	 * @param  int[] $productIds    ID продуктов участвующих в задаче
	 */
	public static function complete($supplyId, $newSupplyLength, $productIds)
	{
		// Обновляем длину исходника
		// Если существуют запасы с такой длиной, то необходимо увеличить их кол-во
		$supply = Supply::find($supplyId);
		$supply->count--;
		$supply->save();
		$newSupply = Supply::firstOrCreate(['length' => $newSupplyLength]);
		$newSupply->width = $supply->width;
		$newSupply->color = $supply->color;
		$newSupply->length = $newSupplyLength;
		$newSupply->count++;
		$newSupply->save();

		// Проставляем статус готовых продуктов
		foreach ($productIds as $productId) {
			$product = Product::find($productId);
			$product->status = 1;
			$product->completed_at = date("Y-m-d H:i:s");
			$product->save();
		}
	}
}