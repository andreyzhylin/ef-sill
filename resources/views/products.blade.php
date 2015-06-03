@extends('layouts.master')
@section('title', 'Наряд-Заказ №868')
@section('content')
	<div class="container">
		<h2>Наряд-Заказ №{{ $order->order_number }}</h2>
	</div>
	<div class="container list">
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Ширина полки "А"</th>
				<th>"L" длина отлива, мм.</th>
				<th>Цвет</th>
				<th>Примечание</th>
				<th>Статус</th>
			</tr>
			@foreach ($order->products()->get() as $index => $product)
				<tr>
					<td>{{ $index+1 }}</td>
					<td>{{ $product->width }}</td>
					<td>{{ $product->length }}</td>
					<td>
						@if ($product->color == 0)
							Белый
						@else
							Золото
						@endif
					</td>
					<td>{{ $product->note }}</td>
					<td>
						@if ($product->status == 0)
							Не выполнено
						@else
							{{ $product->completed_at }}
						@endif
					</td>
				</tr>

			@endforeach
		</table>
	</div>
@stop