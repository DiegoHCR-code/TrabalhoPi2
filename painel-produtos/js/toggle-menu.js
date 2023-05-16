$(document).ready(function(){
    let status = true;
    $('#menu').click(function(){
        if(status){
            $('.menu-painel').css({
                width:'300px',
            });
            $('.menu-item').css({
                left:'0px'
            });
            $('#menu').css({
                transform:'rotate(90deg)',
            });
            
            status = false;
        }else{
            $('.menu-painel').css({
                width:'50px'
            });
            $('.menu-item').css({
                left:'-400px'
            });
            $('#menu').css({
                transform:'rotate(0deg)'
            })
            status = true;
        }
    });
});