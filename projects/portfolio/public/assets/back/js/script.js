let popup = document.querySelector("#create-staff");

function show_popup() {
    popup.style.display="flex";
}

function exit_popup() {
    popup.style.display="none";
}

window.onscroll = () =>{
    popup.style.display="none";
}


//Adding portfolio
function collect_data(e) {

    e.preventDefault();
    let title = document.querySelector("#title");
    let description = document.querySelector("#description");
    let image1 = document.querySelector("#image1");
    let image2 = document.querySelector("#image2");
    let image3 = document.querySelector("#image3");
    let image4 = document.querySelector("#image4");
    let image5 = document.querySelector("#image5");

    // validation
    if (title.value.trim() == "" || !isNaN(title.value.trim())) {
        alert("Please enter a valid title!");
        return;
    }

    if (description.value.trim() == "" || !isNaN(description.value.trim())) {
        alert("Please enter a valid description!");
        return;
    }

    if (image1.files.length == 0) {
        alert("Please upload an image first!");
        return;
    }

    let data = new FormData();
    if (image2.files.length > 0) {
        data.append('image2',image2.files[0]);
    }
    if (image3.files.length > 0) {
        data.append('image3',image3.files[0]);
    }
    if (image4.files.length > 0) {
        data.append('image4',image4.files[0]);
    }
    if (image5.files.length > 0) {
        data.append('image5',image5.files[0]);
    }

    data.append('title',title.value.trim());
    data.append('description',description.value.trim());
    send_data_files(data);
}

function send_data_files(formdata) {
    let ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(){
        if (ajax.readyState == 4 && ajax.status == 200) {
            handle_result(ajax.responseText);
        }
    });

    ajax.open("POST","<?=ROOT?>ajax_portfolio",true);
    ajax.send(formdata);
}

function handle_result(result) {
    console.log(result);
}