<?php $this->load_view("admin/header",$data);?>
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
                    <h1>About</h1>
                    <form action="">
                        <input type="text" name="search" id="search" placeholder="Search a portfolio......">
                        <button onclick="show_popup()" type="button" class="btn add-new"><i class="fa-solid fa-plus-circle"></i> <span>Add new</span></button>
                    </form>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>texts</th>
                                <th >operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($about_me)): ?>
                                <?php $i=0; foreach ($about_me as $about): $i++; ?>
                                    <?php 
                                    
                                        $info = array(); 
                                        $info['id'] = $about->id;
                                        $info['texts'] = $about->texts;
                                        $info = str_replace('"', "'", json_encode($info));                                   
                                    
                                    ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><p><?=$about->texts?></p></td>
                                        <td class="flex-btn">
                                        <button info_about="<?=$info ?>" class="btn" onclick="edit_about(<?=$about->id?>,event)"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn" onclick="delete_about(<?=$about->id?>)"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination">
                    <li><i class="fa-solid fa-angles-left"></i></li>
                    <li><i class="fa-solid fa-chevron-left"></i></li>
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li><i class="fa-solid fa-chevron-right"></i></li>
                    <li><i class="fa-solid fa-angles-right"></i></li>
                </ul>
            </div>
      </section>
     <!-- table section end -->

      <!-- Add Modal -->
    <div class="modal" id="create-about">
        <div class="modal-body">
            <h1 class="heading">Creating About me</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="texts">texts</label>
                    <textarea name="texts" id="texts" class="form-control texts"></textarea>
                </div>

                <div class="form-group flex-btn">
                    <button type="button" class="btn" onclick="collect_data(event)">Save</button>
                    <button type="button" class="btn option-btn" onclick="exit_popup()">Exit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="edit-about">
        <div class="modal-body">
            <h1 class="heading">Editing About me</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="edit-texts">texts</label>
                    <textarea name="texts" id="edit-texts" class="form-control texts" style="height: 400px;"></textarea>
                </div>
                
                <div class="form-group flex-btn">
                    <button type="button" class="btn" onclick="collect_edit_data(event)">Save</button>
                    <button type="button" class="btn option-btn" onclick="exit_popup()">Exit</button>
                </div>
            </form>
        </div>
    </div>

    <?php $this->load_view("admin/footer",$data);?>

<script>
    let popup = document.querySelector("#create-about");
    let popup_edit = document.querySelector("#edit-about");

    function show_popup() {
        popup.style.display="flex";
    }

    function exit_popup(){
        popup.style.display="none";
        popup_edit.style.display="none";
    }

    function collect_data(e) {

        e.preventDefault();
        let texts = document.querySelector("#texts");


        let data = new FormData();

        data.append('texts',texts.value.trim());
        data.append('data_type','add_about_me');
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
                if (obj.data_type == "add_about_me") {
                    if (obj.message_type == "info") {
                        alert(obj.message);
                        exit_popup();
                        window.location.reload();
                    } else {
                        alert(obj.message);
                    }
                } else if(obj.data_type == "edit_about_me") {
                    alert(obj.message);
                    window.location.reload();
                } else if(obj.data_type == "delete_about_me") {
                    alert(obj.message);
                    window.location.reload();
                }
            }
        }
    }

    function edit_about(id,e) {
        popup_edit.style.display="flex";        
        let edit_texts = document.querySelector("#edit-texts");

        if (e) {
            e.preventDefault();
            let a = e.currentTarget.getAttribute("info_about");
            let info = JSON.parse(a.replaceAll("'",'"')); 
            ID = info.id;
            edit_texts.value = info.texts;
        }
        
    }

    function collect_edit_data(e) {

        e.preventDefault();
        let edit_texts = document.querySelector("#edit-texts");
        // validation
        if (edit_texts.value.trim() == "" || !isNaN(edit_texts.value.trim())) {
            alert("Please enter a valid texts!");
            return;
        }

        let data = new FormData();

        data.append('texts',edit_texts.value.trim());
        data.append('id',ID);
        data.append('data_type','edit_about_me');
        send_data_files(data);
    }

    function delete_about(id) {
        if (!confirm("Are you sure you want to delete this about_me?")) {
            return;
        }

        send_data({
            data_type:"delete_about_me",
            id:id
        });
    }

</script>