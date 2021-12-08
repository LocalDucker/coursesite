$('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

$('.check').change(function () {
    if(this.checked){
        $('.btn').removeAttr('disabled');
    }else{
        $('.btn').attr('disabled','disabled');
    }

});