@if (Session::has('success'))
	<div class="mes" id="MesSuc">
		<div class="mes-title">提示信息<a class="right close" href="javascript:void(0)" onclick="return close_win('MesSuc')"></a></div>
		<div class="mes-text green">{{ Session::get('success') }}</div>
		<button type="text" onclick="return close_win('MesSuc')" class="mes-sure">确定</button>
	</div>
@endif

@if (Session::has('error'))
	<div class="mes" id="MesErr">
		<div class="mes-title">提示信息<a class="right close" href="javascript:void(0)" onclick="return close_win('MesErr')"></a></div>
		<div class="mes-text red">{{ Session::get('error') }}</div>
		<button type="text" onclick="return close_win('MesErr')" class="mes-sure">确定</button>
	</div>
@endif