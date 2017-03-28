var Course = function(){

    var publish = function(){
        //console.log($hyall);
        $hyall.actionsHandlers.actionPublish = function(rows){
            $.post($.U('ajax?q=publish'), {pk:rows.join(',')},function(r){
                $hyall.dtActionAlert(r);
            });
        }
    }

    var fullScreen = function() {
        $hyall.on('shown.hyall.form.add', function () {
            $('.hy-form-modal').find('.col-md-3').css({
                width: '15%'
            });
            $('.hy-form-modal').find('.slimScrollDiv').css({
                height:'700px'
            }).children('.scroller').css({height:'700px'});
        }) 
    }
	 return {
        init: function () {
            publish();
            fullScreen();
        }
     };
}();