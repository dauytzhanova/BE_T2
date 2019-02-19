$(".user_field").keypress( function(e){
    var chr = String.fromCharCode(e.which);
    if ("!@#$%^&*()+=-:;?/>,<".indexOf(chr) < 0)
        return true;
    else
        return false;
});



