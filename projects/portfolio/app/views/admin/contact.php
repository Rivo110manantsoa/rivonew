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
                    <h1>Contact</h1>
                    <form action="">
                        <input type="text" name="search" id="search" placeholder="Search a portfolio......">
                        <button type="button" class="btn add-new" onclick="show_popup()"><i class="fa-solid fa-plus-circle"></i> <span>Add new</span></button>
                    </form>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>N0.</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th width="300">operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($contact_me)): ?>
                                <?php $i=0; foreach ($contact_me as $row): $i++; ?>
                                    <?php 
                                    
                                        $info = array(); 
                                        $info['id'] = $row->id;
                                        $info['name'] = $row->name;
                                        $info['message'] = $row->message;
                                        $info['subject'] = $row->subject;
                                        $info['email'] = $row->email;
                                        $info['phone'] = $row->phone;
                                        $info = str_replace('"', "'", json_encode($info));                                   
                                    
                                    ?>
                                    <tr>
                                        <td><?=$i?></td>
                                        <td><p><?=$row->name?></p></td>
                                        <td><p><?=$row->subject?></p></td>
                                        <td><p><?=$row->email?></p></td>
                                        <td><p><?=$row->phone?></p></td>
                                        <td><p><?=$row->message?></p></td>
                                        <td class="flex-btn">
                                            <button info_contact="<?= $info ?>" class="btn" onclick="show_contact(<?=$row->id?>,event)"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button class="btn" onclick="delete_contact(<?=$row->id?>)"><i class="fa-solid fa-trash"></i></button>
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
   
    <!-- Edit Modal -->
    <div class="modal" id="edit-contact">
        <div class="modal-body">
            <h1 class="heading">Showing Contact</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="edit-name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="edit-subject" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="edit-email" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="edit-phone" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">message</label>
                    <textarea name="message" id="edit-message" class="form-control"></textarea>
                </div>
                <div class="form-group flex-btn">
                    <button type="button" class="btn option-btn" onclick="exit_popup()">Exit</button>
                </div>
            </form>
        </div>
    </div>

<?php $this->load_view("admin/footer",$data); ?>

<script>
    let ID = 0;
    let popup_edit = document.querySelector("#edit-contact");

    function exit_popup() {
        popup_edit.style.display="none";
    }

    window.onscroll = () =>{
        popup_edit.style.display="none";
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
                if(obj.data_type == "delete_contact") {
                    alert(obj.message);
                    window.location.reload();
                }
            }
        }
    }

  
    function delete_contact(id) {
        if (!confirm("Are you sure you want to delete this contact?")) {
            return;
        }

        send_data({
            data_type:"delete_contact",
            id:id
        });
    }

    function show_contact(id,e) {
        popup_edit.style.display="flex";        
        let edit_name = document.querySelector("#edit-name");
        let edit_message = document.querySelector("#edit-message");
        let edit_subject = document.querySelector("#edit-subject");
        let edit_email = document.querySelector("#edit-email");
        let edit_phone = document.querySelector("#edit-phone");

        if (e) {
            e.preventDefault();
            let a = e.currentTarget.getAttribute("info_contact");
            let info = JSON.parse(a.replaceAll("'",'"'));
            console.log(info.subject); 
            ID = info.id;
            edit_name.value = info.name;
            edit_message.value = info.message;
            edit_subject.value = info.subject;
            edit_email.value = info.email;
            edit_phone.value = info.phone;
        }
        
    }

</script>