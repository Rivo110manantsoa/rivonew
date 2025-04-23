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
                    <h1>Blog</h1>
                    <form action="">
                        <input type="text" name="search" id="search" placeholder="Search a portfolio......">
                        <button type="button" onclick="show_popup()" class="btn add-new"><i class="fa-solid fa-plus-circle"></i> <span>Add new</span></button>
                    </form>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th width="100">Number</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th  width="100">Image</th>
                                <th>Date</th>
                                <th >operations</th>
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
                                    $info['image'] = $row->image;
                                    $info['date'] = $row->date;
                                    $info = str_replace('"', "'", json_encode($info));                                   
                                
                                ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><p><?=$row->title?></p></td>
                                        <td><p><?=$row->description?></p></td>
                                        <td><img src="<?=ROOT?><?=$row->image?>" alt=""></td>
                                        <td><p><?=date("Y, M, d", strtotime($row->date))?></p></td>
                                        <td class="flex-btn">
                                            <button info_blog="<?= $info ?>" class="btn" onclick="edit_blog(<?=$row->id?>,event)"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="btn" onclick="delete_blog(<?=$row->id?>)"><i class="fa-solid fa-trash"></i></button>
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
            <h1 class="heading">Creating Blog</h1>
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
                <label>Choose an image to your blog</label>
                    <div class="flex-btn">
                        <label for="image" class="form-control"> <span>Image 1</span>
                            <input type="file" name="image" id="image" style="display:none;" onchange="show_image(this.files[0],this.name,'js-add-image')">
                        </label>
                    </div>
                </div>
                <div class="form-group js-add-image flex-btn">
                    <img src="" alt="">
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
            <h1 class="heading">Editing blog</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="edit-title">Title</label>
                    <input type="text" name="title" id="edit-title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edit-description">Description</label>
                    <textarea name="description" id="edit-description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Choose an image to your blog</label>
                    <div class="flex-btn">
                        <label for="edit-image" class="form-control"> <span>Image 1</span>
                            <input type="file" name="image" id="edit-image" style="display:none;" onchange="show_image(this.files[0],this.name,'js-edit-image')">
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
        let image = document.querySelector("#image").value="";
    }

    //Adding portfolio
    function collect_data(e) {

        e.preventDefault();
        let title = document.querySelector("#title");
        let description = document.querySelector("#description");
        let image = document.querySelector("#image");

        // validation
        if (title.value.trim() == "" || !isNaN(title.value.trim())) {
            alert("Please enter a valid title!");
            return;
        }

        if (description.value.trim() == "" || !isNaN(description.value.trim())) {
            alert("Please enter a valid description!");
            return;
        }

        if (image.files.length == 0) {
            alert("Please upload an image first!");
            return;
        }

        let data = new FormData();

        data.append('image',image.files[0]);
        data.append('title',title.value.trim());
        data.append('description',description.value.trim());
        data.append('data_type','add_blog');
        send_data_files(data);
    }

    function collect_edit_data(e) {

        e.preventDefault();
        let edit_title = document.querySelector("#edit-title");
        let edit_description = document.querySelector("#edit-description");
        let edit_image = document.querySelector("#edit-image");

        // validation
        if (edit_title.value.trim() == "" || !isNaN(edit_title.value.trim())) {
            alert("Please enter a valid title!");
            return;
        }

        if (edit_description.value.trim() == "" || !isNaN(edit_description.value.trim())) {
            alert("Please enter a valid description!");
            return;
        }

        let data = new FormData();
        if (edit_image.files.length > 0) {
            data.append('image',edit_image.files[0]);
        }

        data.append('title',edit_title.value.trim());
        data.append('description',edit_description.value.trim());
        data.append('id',ID);
        data.append('data_type','edit_blog');
        send_data_files(data);
    }

    function send_data_files(formdata) {
        let ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function(){
            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST","<?=ROOT?>ajax_blog",true);
        ajax.send(formdata);
    }

    
    function send_data(data={}) {
        let ajax = new XMLHttpRequest();

        ajax.addEventListener('readystatechange', function(){
            if (ajax.readyState == 4 && ajax.status == 200) {
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST","<?=ROOT?>ajax_blog",true);
        ajax.send(JSON.stringify(data));
    }



    function handle_result(result) {
        console.log(result);
        if (result != "") {
            let obj = JSON.parse(result);
            if (typeof obj.message_type != "undefined") {
                if (obj.data_type == "add_blog") {
                    if (obj.message_type == "info") {
                        alert(obj.message);
                        exit_popup();
                        clear_fields();
                        window.location.reload();
                    } else {
                        alert(obj.message);
                    }
                } else if(obj.data_type == "edit_blog") {
                    alert(obj.message);
                    window.location.reload();
                } else if(obj.data_type == "delete_blog") {
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

    function delete_blog(id) {
        if (!confirm("Are you sure you want to delete this blog?")) {
            return;
        }

        send_data({
            data_type:"delete_blog",
            id:id
        });
    }

    function edit_blog(id,e) {
        popup_edit.style.display="flex";        
        let edit_title = document.querySelector("#edit-title");
        let edit_description = document.querySelector("#edit-description");
        let edit_image = document.querySelector("#edit-image");

        if (e) {
            e.preventDefault();
            let a = e.currentTarget.getAttribute("info_blog");
            let info = JSON.parse(a.replaceAll("'",'"'));
            console.log(info.image1); 
            ID = info.id;
            edit_title.value = info.title;
            edit_description.value = info.description;

            let portf_images = document.querySelector(".js-edit-image");
            portf_images.innerHTML = `<img src="<?=ROOT?>${info.image}">`;
            console.log(portf_images);
        }
        
    }

</script>
