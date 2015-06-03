@extends('layouts.master')
@section('title', 'Запасы')
@section('content')

	<div class="container">
		<form action="/supply" method="POST" class="form-horizontal">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="id" value="{{ $supply->id }}">
			<div class="form-group">
				<label for="width" class="col-sm-2 control-label">Ширина мм.</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="width" name="width" aria-describedby="width-error" placeholder="Ширина" value="{{ $supply->width }}" @if ($supply->id) disabled @endif>
				  <span id="width-error" class="help-block"><?= $errors->first('width') ?></span>
				</div>
			</div>
			<div class="form-group">
				<label for="color" class="col-sm-2 control-label">Цвет</label>
				<div class="col-sm-10">
					<select class="form-control" id="color" name="color" @if ($supply->id) disabled @endif>
					  <option value="0" @if ($supply->color == 0) selected="selected" @endif>Белый</option>
					  <option value="1" @if ($supply->color == 1) selected="selected" @endif>Золото</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="length" class="col-sm-2 control-label">Длина мм.</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="length" name="length" aria-describedby="length-error" placeholder="Длина" value="{{ $supply->length }}" @if ($supply->id) disabled @endif>
				  <span id="length-error" class="help-block"><?= $errors->first('length') ?></span>
				</div>
			</div>
			<div class="form-group">
				<label for="count" class="col-sm-2 control-label">Количество</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="count" name="count" aria-describedby="count-error" placeholder="Количество" value="{{ $supply->count }}">
				  <span id="count-error" class="help-block"><?= $errors->first('count') ?></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-primary">Сохранить</button>
				</div>
			</div>
		</form>
	</div>
@stop