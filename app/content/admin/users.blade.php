<?php
$db=new \clinela\database\DB();
$users=$db->getAllUsers();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="#send-mails" class="btn-primary btn btn-rounded mb-2" data-toggle="modal"> <i class="fe fe-mail"></i> Send emails</a>
                </div>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>email</th>
                                <th>Phone</th>
                                <th>role</th>
                                <th>Joined</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($users)) {
                                foreach ($users as $user){
                                    $status=$user['status']==1?'checked=""':'';
                                    $meta=$db->getUserMeta($user['id']);
                                    $role='Patient';
                                    if($meta['role']==1){$role='Doctor';}
                                    if($meta['role']==3){$role='Admin';}
                                    echo '<tr>
                                    <td>#'.$user['id'].'</td>
                                    <td>'.$user['username'].'</td>
                                    <td>'.$user['email'].'</td>
                                    <td>'.$meta['phone'].'</td>

                                    <td>'.$role.'</td>
                                    <td>'.date("d M Y",strtotime($user['created_at'])).'</td>
                                    <td><div class="status-toggle" onclick="change_status(\'st\','.$user['id'].')">
															<input type="checkbox" id="status_'.$user['id'].'" class="check" '.$status.'>
															<label for="status_'.$user['id'].'" class="checktoggle">checkbox</label>
														</div></td>
                                     <td class="text-right">
                                        <div class="actions">
                                            <a  href="'.BASE_PATH.'admin/users/'.$user['id'].'/" class="btn btn-sm bg-info-light">
                                                <i class="fe fe-user"></i>
                                            </a>
                                            <a  href="'.BASE_PATH.'chat/'.$user['id'].'/" class="btn btn-sm bg-primary-light">
                                                <i class="fe fe-messanger"></i>
                                            </a>
                                            <a  href="?d='.$user['id'].'&sub=sp" class="btn btn-sm bg-danger-light">
                                                <i class="fe fe-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>';
                                }
                            }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="send-mails" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Emails</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row form-row">
                        <div class="col-12 col-lg-8">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" class="form-control" name="subject" required="required">
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="form-group">
                                <label>User type</label>
                                <select type="text" class="form-control" name="role">
                                    <option value="3">All Users</option>
                                    <option value="1">Doctors</option>
                                    <option value="0">Patients</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control summernote" rows="5" name="message"></textarea>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Send Emails</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /ADD Modal -->

<script>
    function reqListener() {
        console.log(this.responseText);
        Swal.fire({
            title: "Success",
            text: this.responseText,
            icon: "success",
        });
    }

    function change_status(st,id) {
        var oReq = new XMLHttpRequest();
        oReq.addEventListener("load", reqListener);
        oReq.open("GET", "<?php echo BASE_PATH?>admin/endpoint/?sub="+st+"&d="+id);
        oReq.send();
    }
</script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>