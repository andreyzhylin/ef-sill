@extends('layouts.master')
@section('title', 'Заказы')
@section('content')
	<div class="container">
		<form enctype="multipart/form-data">
			<h3>Добавить заказ:</h3>
			<input type="file" name="order_file" id="order_file">
			<a class="btn btn-default" href="javascript:void(0)" id="start_loading">Начать загрузку</a>
		</form>
	</div>
	<div class="container list">
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Наряд-Заказ №</th>
				<th>Добавлен</th>
				<th>Наименование клиента</th>
				<th>Оракал №</th>
				<th>Выполнено</th>
				<th>Просмотр</th>
				<th>Удалить</th>
			</tr>
			@foreach ($orders as $index => $order)
				<tr>
					<td>{{ $index+1 }}</td>
					<td>{{ $order->order_number }}</td>
					<td>{{ $order->created_at }}</td>
					<td>{{ $order->client_name }}</td>
					<td>{{ $order->oracle_number }}</td>
					<td>{{ $order->products()->where('status', 1)->count() }} / {{ $order->products()->count() }}</td>
					<td><a href="/order/{{ $order->id }}">Подробнее</a></td>
					<td>
						@if ($order->completedProductsCount == 0)
							<a class="delete-order" href="javascript:void(0)" data-id="{{ $order->id }}">Удалить</a>
						@endif
					</td>
				</tr>

			@endforeach
		</table>
	</div>
	{!! $orders->render() !!}
@stop