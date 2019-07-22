/*
 * 前后台共用
 * add by pjh 20180409
 */

// 关闭（隐藏）指定窗口
function close_win(formId) {
	document.getElementById(formId).style.display = "none";
}

// 显示指定表单
function form_display(formId) {
	document.getElementById(formId).style.display = "block";
}