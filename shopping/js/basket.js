
/*


var basket=[];
var o={};
function addToCart(index) {
    let added=false;
    num=0;

    if(sessionStorage.getItem("Cart")){
        basket=JSON.parse(sessionStorage.getItem("Cart"));
        for(i=0;i<basket.length;i++){
            if (basket[i].index == index) {
                basket[i].value+=1;
                added=true;
                break;
            }
        }
    }

    if (!added){
        o.index=index;
        o.value=1;
        basket[basket.length]=o;
    }
    sessionStorage.setItem("Cart",JSON.stringify(basket));


    //setting the cookie
    var allCookies = document.cookie;
    all=allCookies.split(";");
    for(i=0;i<all.length;i++){
        kv=all[i].split("=");
        if (kv[0]==index){
            num=kv[1];
            break;
        }
    }
    num++;
    alert("You added item to a Basket!");
    document.cookie=index + "=" + num;

}

[{"index":7,"value":6},{"index":5,"value":6},{"index":1,"value":3}]

*/


function remove(index) {
    num=0;

    //setting the cookie
    var allCookies = document.cookie;
    all=allCookies.split(";");
    for(i=0;i<all.length;i++){
        kv=all[i].split("=");
        if (kv[0]==index){
            num=kv[1];
            break;
        }
    }
    --num;
    let td = document.getElementById("quantity"+index);
    td.innerHTML=num;
    if (num===0){
        document.cookie=index + "; expires=Thu, 01 Jan 1970 00:00:00 UTC";
        let tr = document.getElementById("quant"+index);
        let newtr = document.createElement("tr");
        tr.childNodes= newtr.childNodes;
        alert(JSON.stringify( tr.childNodes));
    }
    else {
    document.cookie=index + "=" + num;
}

}

