/**
 * 首页JS
 */
var Index = function(){
	var initPage = function(){
		$('.time-now').html($.date('Y年m月d日 x'));
		$('.notice').on('click','.notice-file-down',function(e){
			e.preventDefault();
			e.stopPropagation();
			location.href=$(this).data('url');
		});
	};
	return {
		init:function(){
			initPage();
		}
	};
}();