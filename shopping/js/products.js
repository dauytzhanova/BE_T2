function add() {
    let form = document.createElement("form");
    form.method = 'post';
    form.action = 'admin.php';
    form.id="big_form";

    let gender = document.createElement("select");
    gender.id="select_gender";
    let op1 = document.createElement("option");
    let op2 = document.createElement("option");
    let op3 = document.createElement("option");
    op1.value="Male";
    op1.innerHTML = "Male";
    op2.value="Female";
    op2.innerHTML = "Female";
    op3.value="Kids";
    op3.innerHTML = "Kids";
    gender.name = "gender";
    gender.required = true;
    gender.appendChild(op1);
    gender.appendChild(op2);
    gender.appendChild(op3);
    form.appendChild(gender);

    let name = document.createElement("input");
    name.type = "text";
    name.name = "name";
    name.required = true;
    name.placeholder = "Name of the product";
    form.appendChild(name);

    let size = document.createElement("input");
    size.type = "text";
    size.name = "size";
    size.required = true;
    size.placeholder = "Which size";
    form.appendChild(size);

    let balance = document.createElement("input");
    balance.type = "number";
    balance.name = "balance";
    balance.required = true;
    balance.placeholder = "How much you have";
    form.appendChild(balance);

    let price = document.createElement("input");
    price.type = "number";
        price.name = "price";
        price.required = true;
        price.placeholder = "The price";
        form.appendChild(price);

        let submit = document.createElement("input");
        submit.type = "submit";
        submit.value = "Add";
        submit.id ="add-prod";
        form.appendChild(submit);

        let divka = document.getElementById("add_product");
        divka.removeChild(document.getElementById("add_img1"));
        divka.appendChild(form);
}function add_img(){
    console.log("yes");

    let form = document.createElement("form");
    form.id = 'small_form';
    form.method = 'post';
    form.action = 'admin.php';
    form.enctype = "multipart/form-data";

    let img = document.createElement("input");
    img.id="choose_file";
    img.type = "file";
    img.name = "image";
    form.appendChild(img);

    let submit = document.createElement("input");
    submit.id="insert_img";
    submit.type = "submit";
    submit.name = "insert";
    submit.value ="Insert";
    form.appendChild(submit);

    let divka = document.getElementById("add_img");
    divka.removeChild(document.getElementById("item-img2"));
    divka.appendChild(form);
}