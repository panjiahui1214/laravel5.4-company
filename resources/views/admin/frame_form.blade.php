@extends('admin.frame')

@section('content')
	@yield('form_menu')

	<div class="div-table margin-t10">
		<form method="post" class="form-submit" enctype=@yield('enctype')>
			{{ csrf_field() }}

			<table class="table-all table-blue">
				<tr>
					<th colspan="2" class="txt-left padding-lr20">
						@yield('action')@yield('who')
					</th>
				</tr>
				@yield('form_content')
				<tr>
					<td colspan="2" class="txt-right">
						<button class="txt-right margin-lr20" type="submit">确定</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
@stop