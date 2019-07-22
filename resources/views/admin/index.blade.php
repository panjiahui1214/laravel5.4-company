@extends('admin.frame')

@section('content')
    <div class="right-index-title">系统信息</div>
    <table class="right-index-content">
    	<tr>
    		<td class="right-index-li">服务器：</td>
    		<td>{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
    	</tr>
    	<tr>
    		<td class="right-index-li">操作系统：</td>
    		<td>{{ php_uname('s').php_uname('r') }}</td>
    	</tr>
    	<tr>
    		<td class="right-index-li">php版本：</td>
    		<td>{{ PHP_VERSION }}</td>
    	</tr>
    	<tr>
    		<td class="right-index-li">mysql版本：</td>
    		<td>{{ $mysqlVersion[0]->version }}</td>
    	</tr>
    	<tr>
    		<td class="right-index-li">laravel版本：</td>
    		<td>{{ $laravel::VERSION }}</td>
    	</tr>
    	<tr>
    		<td class="right-index-li">最大上传文件大小：</td>
    		<!-- 从php配置文件中获取 -->
    		<td>{{ ini_get("upload_max_filesize") }}</td>
    	</tr>
    	<tr>
    		<td class="right-index-li">最长执行时间：</td>
    		<td>{{ ini_get("max_execution_time")."秒" }}</td>
    	</tr>
    </table>
@stop