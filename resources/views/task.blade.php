@extends('layouts.master')
@section('title', 'Задачи')
@section('content')
<div class="container">
	<h2>Текущая задача</h2>
	@if (isset($message))
		<h3>{{ $message }}</h3>
	@else
		<table class="table">
			<caption><h3>Исходные данные</h3></caption>
			<tr>
				<th>&nbsp;</th>
				<th>Ширина мм.</th>
				<th>Цвет</th>
				<th>Длина мм.</th>
				<th>&nbsp;</th>
			</tr>
			<tr>
				<td></td>
				<td>{{ $supply->width }}</td>
				<td>
					@if ($supply->color == 0)
						Белый
					@else
						Золото
					@endif
				</td>
				<td>{{ $supply->length }}</td>
				<td></td>
			</tr>
		</table>
		<table class="table">
			<caption><h3>Результат</h3></caption>
			<tr>
				<th>#</th>
				<th>Ширина мм.</th>
				<th>Цвет</th>
				<th>Длина мм.</th>
				<th>Заказ-Наряд №</th>
				<th>Примечание</th>
			</tr>
			@foreach ($products as $index => $product)
				<tr>
					<td>{{ $index+1 }}</td>
					<td>{{ $product->width }}</td>
					<td>
						@if ($product->color == 0)
							Белый
						@else
							Золото
						@endif
					</td>
					<td>{{ $product->length }}</td>
					<td>{{ $product->order->order_number }}</td>
					<td>{{ $product->note }}</td>
				</tr>
			@endforeach
		</table>
		<table class="table">
			<caption><h3>Остаток</h3></caption>
			<tr>
				<th>&nbsp;</th>
				<th>Ширина мм.</th>
				<th>Цвет</th>
				<th>Длина мм.</th>
				<th>&nbsp;</th>
			</tr>
			<tr>
				<td></td>
				<td>{{ $newSupply->width }}</td>
				<td>
					@if ($newSupply->color == 0)
						Белый
					@else
						Золото
					@endif
				</td>
				<td>{{ $newSupply->length }}</td>
				<td></td>
			</tr>
		</table>
		<form action="/task/complete" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="supplyId" value="{{ $supply->id }}">
			@foreach ($products as $index => $product)
				<input type="hidden" name="productIds[]" value="{{ $product->id }}">
			@endforeach
			<input type="hidden" name="newSupplyLength" value="{{ $newSupply->length }}">
			<input type="submit" value="Готово" class="btn btn-primary">
		</form>
	@endif
</div>
@stop