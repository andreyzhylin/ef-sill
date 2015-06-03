@extends('layouts.master')
@section('title', 'Запасы')
@section('content')
	<div class="container">
		<ul class="widths">
			<li>Ширина: </li>
			@for ($i = 100; $i <= 700; $i += 50)
				<li>
					@if ($width == $i)
						{{ $i }}
					@else
						<a href="/supplies/{{ $i }}">{{ $i }}</a>
					@endif
				</li>
			@endfor
		</ul>
	</div>
	<div class="container">
		<a class="btn btn-primary" href="/supply?width={{ $width }}">Добавить</a>
		<a class="btn btn-default" target="_blank" href="/export/supplies">Экспорт запасов</a>
	</div>
	<div class="container list">
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>Ширина мм.</th>
				<th>Цвет</th>
				<th>Длина мм.</th>
				<th>Количество</th>
				<th>Изменить</th>
				<th>Удалить</th>
			</tr>
			@foreach ($supplies as $index => $supply)
				<tr>
					<td>{{ $index+1 }}</td>
					<td>{{ $supply->width }}</td>
					<td>
						@if ($supply->color == 0)
							Белый
						@else
							Золото
						@endif
					</td>
					<td>{{ $supply->length }}</td>
					<td>{{ $supply->count }}</td>
					<td><a href="/supply/{{ $supply->id }}">Изменить</a></td>
					<td><a class="delete-supply" href="javascript:void(0)" data-id="{{ $supply->id }}">Удалить</a></td>
				</tr>

			@endforeach
		</table>
	</div>
@stop