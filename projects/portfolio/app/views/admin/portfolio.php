<?php $this->load_view("admin/header",$data); ?>
     <!-- table section start  -->
      <section class="table">
            <div class="table-header">
                <h1 class="heading">quick options</h1>
                <div class="box-container">
                    <div class="box">
                        <h3 class="heading">portfolio projects</h3>
                        <div class="flex-btn">
                            <a href="<?=ROOT?>home_admin/portfolio" class="btn">View list project (admin)</a>
                            <a href="<?=ROOT?>home/portfolio" class="btn">View list project (user)</a>
                        </div>
                    </div>
                    <div class="box">
                        <h3 class="heading">blog technologies</h3>
                        <div class="flex-btn">
                            <a href="<?=ROOT?>home_admin/blog" class="btn">View list project (admin)</a>
                            <a href="<?=ROOT?>home/blog" class="btn">View list project (user)</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="table-header2">
                    <h1>portfolio</h1>
                    <form action="">
                        <input type="text" name="search" id="search" placeholder="Search a portfolio......">
                        <button type="button" onclick="show_popup()" class="btn add-new"><i class="fa-solid fa-plus-circle"></i> <span>Add new</span></button>
                    </form>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Link</th>
                                <th>Image</th>
                                <th width="200">operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($rows) && is_array($rows)): ?>
                                <?php $i=0; foreach ($rows as $row): $i++;?>
                                <?php 
                                
                                    $info = array(); 
                                    $info['id'] = $row->id;
                                    $info['title'] = $row->title;
                                    $info['description'] = $row->description;
                                    $info['link'] = $row->link;
                                    $info['image1'] = $row->image1;
                                    $info['image2'] = $row->image2;
                                    $info['image3'] = $row->image3;
                                    $info['image4'] = $row->image4;
                                    $info['image5'] = $row->image5;
                                    $info = str_replace('"', "'", json_encode($info));                                   
                                
                                ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><p><?=$row->title?></p></td>
                                        <td><p><?=$row->description?></p></td>
                                        <td><p><?=$row->link?></p></td>
                                        <td><img src="<?=ROOT?><?=$row->image1?>" alt=""></td>
                                        <td class="flex-btn">
                                            <button info_portfolio="<?= $info ?>" class="btn" onclick="edit_portfolio(<?=$row->id?>,event)"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="btn" onclick="delete_portfolio(<?=$row->id?>)"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <p>No data found!</p>
                            <?php endif; ?>   
                        </tbody>
                    </table>   
                </div>
                <?=Page::show_pagination();?>
            </div>
      </section>
     <!-- table section end -->

     <!-- Add Modal -->
    <div class="modal" id="create-staff">
        <div class="modal-body">
            <h1 class="heading">Creating Portfolio</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="link">Link to your </label>
                    <input type="text" name="link" id="link" class="form-control">
                </div>
                <div class="form-group">
                    <label>Choose many images to your portfolio</label>
                    <div class="flex-btn">
                        <label for="image1" class="form-control"> <span>Image 1</span>
                            <input type="file" name="image1" id="image1" style="display:none;" onchange="show_image(this.files[0],this.name,'js-add-image')">
                        </label>
                        <label for="image2" class="form-control"> <span>Image 2</span>
                            <input type="file" name="image2" id="image2" style="display:none;" onchange="show_image(this.files[0],this.name,'js-add-image')">
                        </label>
                        <label for="image3" class="form-control"> <span>Image 3</span>
                            <input type="file" name="image3" id="image3" style="display:none;" onchange="show_image(this.files[0],this.name,'js-add-image')">
                        </label>
                        <label for="image4" class="form-control"> <span>Image 4</span>
                            <input type="file" name="image4" id="image4" style="display:none;" onchange="show_image(this.files[0],this.name,'js-add-image')">
                        </label>
                        <label for="image5" class="form-control"> <span>Image 5</span>
                            <input type="file" name="image5" id="image5" style="display:none;" onchange="show_image(this.files[0],this.name,'js-add-image')">
                        </label>
                    </div>
                </div>
                <div class="form-group js-add-image flex-btn">
                    <img src="" alt=""><img src="" alt=""><img src="" alt=""><img src="" alt=""><img src="" alt="">
                </div>
                <div class="form-group flex-btn">
                    <button type="button" class="btn" onclick="collect_data(event)">Save</button>
                    <button type="button" class="btn option-btn" onclick="exit_popup()">Exit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="edit-staff">
        <div class="modal-body">
            <h1 class="heading">Editing Portfolio</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="edit-title">Title</label>
                    <input type="text" name="title" id="edit-title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="link">Link to your </label>
                    <input type="text" name="link" id="edit-link" class="form-control">
                </div>

                <div class="form-group">
                    <label for="edit-description">Description</label>
                    <textarea name="description" id="edit-description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Choose many images to your portfolio</label>
                    <div class="flex-btn">
                        <label for="edit-image1" class="form-control"> <span>Image 1</span>
                            <input type="file" name="image1" id="edit-image1" style="display:none;" onchange="show_image(this.files[0],this.name,'js-edit-image')">
                        </label>
                        <label for="edit-image2" class="form-control"> <span>Image 2</span>
                            <input type="file" name="image2" id="edit-image2" style="display:none;" onchange="show_image(this.files[0],this.name,'js-edit-image')">
                        </label>
                        <label for="edit-image3" class="form-control"> <span>Image 3</span>
                            <input type="file" name="image3" id="edit-image3" style="display:none;" onchange="show_image(this.files[0],this.name,'js-edit-image')">
                        </label>
                        <label for="edit-image4" class="form-control"> <span>Image 4</span>
                            <input type="file" name="image4" id="edit-image4" style="display:none;" onchange="show_image(this.files[0],this.name,'js-edit-image')">
                        </label>
                        <label for="edit-image5" class="form-control"> <span>Image 5</span>
                            <input type="file" name="image5" id="edit-image5" style="display:none;" onchange="show_image(this.files[0],this.name,'js-edit-image')">
                        </label>
                    </div>
                </div>
                <div class="form-group js-edit-image flex-btn">
                    <img src="" alt=""><img src="" alt=""><img src="" alt=""><img src="" alt=""><img src="" alt="">
                </div>
                <div class="form-group flex-btn">
                    <button type="button" class="btn" onclick="collect_edit_data(event)">Save</button>
                    <button type="button" class="btn option-btn" onclick="exit_popup()">Exit</button>
                </div>
            </form>
        </div>
    </div>
<?php $this->load_view("admin/footer",$data); ?>
    
<script>
    let ID = 0;
    let popup = document.querySelector("#create-staff");
    let popup_edit = document.querySelector("#edit-staff");

    function show_popup() {
        popup.style.display="flex";
    }

    function exit_popup() {
        popup.style.display="none";
        popup_edit.style.display="none";
    }

    window.onscroll = () =>{
        popup.style.display="none";
        popup.style.display="none";
        popup_edit.style.display="none";
    }

    function clear_fields(){
        let title = document.querySelector("#title").value="";
        let description = document.querySelector("#description").value="";
        let link = document.querySelector("#link").value="";
        let image1 = document.querySelector("#image1").value="";
        let image2 = document.querySelector("#image2").value="";
        let image3 = document.querySelector("#image3").value="";
        let image4 = document.querySelector("#image4").value="";
        let image5 = document.querySelector("#image5").value="";
    }

    //Adding portfolio
    function collect_data(e) {

        e.preventDefault();
        let title = document.querySelector("#title");
        let description = document.querySelector("#description");
        let link = document.querySelector("#link");
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

        if (link.value.trim() == "" || !isNaN(link.value.trim())) {
            alert("Please enter a valid link!");
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

        data.append('image1',image1.files[0]);
        data.append('title',title.value.trim());
        data.append('description',description.value.trim());
        data.append('link',link.value.trim());
        data.append('data_type','add_portfolio');
        send_data_files(data);
    }

    function collect_edit_data(e) {

        e.preventDefault();
        let edit_title = document.querySelector("#edit-title");
        let edit_link = document.querySelector("#edit-link");
        let edit_description = document.querySelector("#edit-description");

        let edit_image1 = document.querySelector("#edit-image1");
        let edit_image2 = document.querySelector("#edit-image2");
        let edit_image3 = document.querySelector("#edit-image3");
        let edit_image4 = document.querySelector("#edit-image4");
        let edit_image5 = document.querySelector("#edit-image5");

        // validation
        if (edit_title.value.trim() == "" || !isNaN(edit_title.value.trim())) {
            alert("Please enter a valid title!");
            return;
        }

        if (edit_description.value.trim() == "" || !isNaN(edit_description.value.trim())) {
            alert("Please enter a valid description!");
            return;
        }

        if (edit_link.value.trim() == "" || !isNaN(edit_link.value.trim())) {
            alert("Please enter a valid link!");
            return;
        }

        let data = new FormData();
        if (edit_image1.files.length > 0) {
            data.append('image1',edit_image1.files[0]);
        }
        if (edit_image2.files.length > 0) {
            data.append('image2',edit_image2.files[0]);
        }
        if (edit_image3.files.length > 0) {
            data.append('image3',edit_image3.files[0]);
        }
        if (edit_image4.files.length > 0) {
            data.append('image4',edit_image4.files[0]);
        }
        if (edit_image5.files.length > 0) {
            data.append('image5',edit_image5.files[0]);
        }

        data.append('title',edit_title.value.trim());
        data.append('description',edit_description.value.trim());
        data.append('link',edit_link.value.trim());
        data.append('id',ID);
        data.append('data_type','edit_portfolio');
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

    
    function send_data(data={}) {
        let ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function(){
            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST","<?=ROOT?>ajax_portfolio",true);
        ajax.send(JSON.stringify(data));
    }



    function handle_result(result) {
        console.log(result);
        if (result != "") {
            let obj = JSON.parse(result);
            if (typeof obj.message_type != "undefined") {
                if (obj.data_type == "add_portfolio") {
                    if (obj.message_type == "info") {
                        alert(obj.message);
                        exit_popup();
                        clear_fields();
                        window.location.reload();
                    } else {
                        alert(obj.message);
                    }
                } else if(obj.data_type == "edit_portfolio") {
                    alert(obj.message);
                    window.location.reload();
                } else if(obj.data_type == "delete_portfolio") {
                    alert(obj.message);
                    window.location.reload();
                }
            }
        }
    }

    // Function to show selected image in the appropriate modal
    function show_image(filetype, filename, element) {
        console.log('Element ciblé:', element);
        let index = 0;
        if (filename == "image2") {
            index = 1;
        } else if (filename == "image3") {
            index = 2;
        } else if (filename == "image4") {
            index = 3;
        } else if (filename == "image5") {
            index = 4;
        }

        let image_holders = document.querySelector("." + element);
        if (!image_holders) {
            console.error("Élément introuvable : " + element);
            return;
        }
        let images = image_holders.querySelectorAll("IMG");
        if (images[index]) {
            images[index].src = URL.createObjectURL(filetype);
        } else {
            console.error("Index d'image incorrect : " + index);
        }
    }

    function delete_portfolio(id) {
        if (!confirm("Are you sure you want to delete this portfolio?")) {
            return;
        }

        send_data({
            data_type:"delete_portfolio",
            id:id
        });
    }

    function edit_portfolio(id,e) {
        popup_edit.style.display="flex";        
        let edit_title = document.querySelector("#edit-title");
        let edit_description = document.querySelector("#edit-description");
        let edit_link = document.querySelector("#edit-link");
        let edit_image1 = document.querySelector("#edit-image1");
        let edit_image2 = document.querySelector("#edit-image2");
        let edit_image3 = document.querySelector("#edit-image3");
        let edit_image4 = document.querySelector("#edit-image4");
        let edit_image5 = document.querySelector("#edit-image5");

        if (e) {
            e.preventDefault();
            let a = e.currentTarget.getAttribute("info_portfolio");
            let info = JSON.parse(a.replaceAll("'",'"'));
            console.log(info.image1); 
            ID = info.id;
            edit_title.value = info.title;
            edit_description.value = info.description;
            edit_link.value = info.link;

            let portf_images = document.querySelector(".js-edit-image");
            portf_images.innerHTML = `<img src="<?=ROOT?>${info.image1}">`;
            portf_images.innerHTML += `<img src="<?=ROOT?>${info.image2}">`;
            portf_images.innerHTML += `<img src="<?=ROOT?>${info.image3}">`;
            portf_images.innerHTML += `<img src="<?=ROOT?>${info.image4}">`;
            portf_images.innerHTML += `<img src="<?=ROOT?>${info.image5}">`;
            console.log(portf_images);
        }
        
    }

</script>
