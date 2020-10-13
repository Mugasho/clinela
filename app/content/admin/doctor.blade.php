<?php
$db=new \clinela\database\DB();
$doctors=$db->getUsersByRole(1);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="datatable table table-hover table-center mb-0">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Doctor Name</th>
                                <th>Speciality</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Joined</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($doctors)) {
                                foreach ($doctors as $doctor){
                                    $status=$doctor['approved']==1?'checked=""':'';
                                    $names=empty($doctor['first_name'])&& empty($doctor['last_name'])?$doctor['username']:$doctor['first_name'].' '.$doctor['last_name'];
                                    $img=!empty($doctor['photo'])?CONTENT_PATH.'uploads/'.$doctor['photo']:CONTENT_PATH.'public/img/patients/patient1.jpg';
                                    $city=!empty($doctor['city'])?$doctor['city'].', ':'';
                                    $state=!empty($doctor['state'])?$doctor['state'].', ':'';
                                    $country=!empty($doctor['country'])?$doctor['country']:'';
                                    echo '<tr>
                                    <td>#'.$doctor['id'].'</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="'.BASE_PATH.'admin/user/'.$doctor['id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.$img.'" alt="User Image"></a>
                                            <a href="'.BASE_PATH.'admin/user/'.$doctor['id'].'/">'.$names.' </a>
                                        </h2>
                                    </td>
                                    <td>29</td>
                                    <td>'.$city.$state.$country.'</td>
                                    <td>'.$doctor['phone'].'</td>
                                    <td>'.date("d,M Y",strtotime($doctor['created_at'])).'</td>
                                    <td><div class="status-toggle" onclick="change_status(\'dr\','.$doctor['id'].')">
															<input type="checkbox" id="status_'.$doctor['id'].'" class="check" '.$status.'>
															<label for="status_'.$doctor['id'].'" class="checktoggle">checkbox</label>
														</div></td>
                                     <td class="text-right">
                                        <div class="actions">
                                        <a class="btn btn-sm bg-primary-light"  href="?d='.$doctor['id'].'&sub=up">
                                                <i class="fe fe-download"></i>
                                            </a>
                                            <a class="btn btn-sm bg-success-light"  href="'.BASE_PATH.'doctors/'.$doctor['id'].'/">
                                                <i class="fe fe-eye"></i>
                                            </a>
                                            <a  href="?d='.$doctor['id'].'&sub=sp" class="btn btn-sm bg-danger-light">
                                                <i class="fe fe-trash"></i>
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

<script>

    function change_status(st,id) {
        window.location="?sub="+st+"&d="+id;
    }

</script>