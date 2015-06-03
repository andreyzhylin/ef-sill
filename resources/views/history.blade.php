@extends('layouts.master')
@section('title', 'Журнал')
@section('content')

	<div class="container list">
		<table class="table table-striped">
			<tr>
				<th>Ширина полки "А"</th>
				<th>"L" длина отлива, мм.</th>
				<th>Цвет</th>
				<th>Заказ-Наряд №</th>
				<th>Примечание</th>
				<th>Дата выполнения</th>
			</tr>
			@foreach ($products as $index => $product)
				<tr>
					<td>{{ $product->width }}</td>
					<td>{{ $product->length }}</td>
					<td>
						@if ($product->color == 0)
							Белый
						@else
							Золото
						@endif
					</td>
					<td>{{ $product->order->order_number }}</td>
					<td>{{ $product->note }}</td>
					<td>{{ $product->completed_at }}</td>
				</tr>

			@endforeach
		</table>
		{!! $products->render() !!}
	</div>
@stop