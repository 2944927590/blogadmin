/**
 * Created by xmy on 2016/3/30.
 */
var Category = function(){
    var hiddenC = function(){
        var modal = $hyall.getFormModal();
        modal.on('change','#pid',function(){
            //console.log($(this).val());
            if($(this).val()){
                $('#name').parent().parent()[0].style.display='';
            }else{
                $('#name').parent().parent()[0].style.display='none';
            }
        })
    }


    return {
        init : function(){
            hiddenC();
        }
    }
}();