@extends('home.user.frame')

@section('main')
	<table class="user-active-table">
		<tr>
			<th colspan="2" class="txt-center">参与活动列表</th>
		</tr>
		@foreach ($actives as $active)
			<tr>
				<td colspan="2">
					<a href="{{ '/user/active/detail/'.$active->id.'/ae' }}" class="blue left">
						{{ $active->name }}——{{ $active->theme->name }}
					</a>

					<a href="{{ '/user/active/detail/'.$active->id.'/ae' }}" class="blue right margin-l15">
						查看详情
					</a>
				</td>
			</tr>
		@endforeach
	</table>
@stop