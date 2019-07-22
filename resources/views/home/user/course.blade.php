@extends('home.user.frame')

@section('main')
	<table class="user-active-table">
		<tr>
			<th colspan="2" class="txt-center">参加课程列表</th>
		</tr>
		@foreach ($courses as $course)
			<tr>
				<td colspan="2">
					<a href="{{ '/user/course/detail/'.$course->id.'/ce' }}" class="blue left">
						{{ $course->name }}
					</a>

					<a href="{{ '/user/course/detail/'.$course->id.'/ce' }}" class="blue right margin-l15">
						查看详情
					</a>
				</td>
			</tr>
		@endforeach
	</table>
@stop