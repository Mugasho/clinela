<?php
$db=new \clinela\database\DB();
$patients=$db->getUsersByRole(0);
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
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Added</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($patients)) {
                                foreach ($patients as $patient){
                                    $names=empty($patient['first_name'])&& empty($patient['last_name'])?$patient['username']:$patient['first_name'].' '.$patient['last_name'];
                                    $img=!empty($patient['photo'])?CONTENT_PATH.'uploads/'.$patient['photo']:CONTENT_PATH.'public/img/patients/patient1.jpg';
                                    $city=!empty($patient['city'])?$patient['city'].', ':'';
                                    $state=!empty($patient['state'])?$patient['state'].', ':'';
                                    $country=!empty($patient['country'])?$patient['country']:'';
                                    $status=$patient['role']==1?'checked=""':'';
                                    echo '<tr>
                                    <td>#PT'.$patient['id'].'</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['id'].'/" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="'.$img.'" alt="User Image"></a>
                                            <a href="'.BASE_PATH.'doctor/patient/'.$patient['id'].'/">'.$names.' </a>
                                        </h2>
                                    </td>
                                    <td>29</td>
                                    <td>'.$city.$state.$country.'</td>
                                    <td>'.$patient['phone'].'</td>
                                    <td>'.date("d M Y",strtotime($patient['created_at'])).'</td>
                                    <td><div class="status-toggle" onclick="change_status(\'dr\','.$patient['id'].')">
															<input type="checkbox" id="status_'.$patient['id'].'" class="check" '.$status.'>
															<label for="status_'.$patient['id'].'" class="checktoggle">checkbox</label>
														</div></td>
                                     <td class="text-right">
                                        <div class="actions">
                                            <a class="btn btn-sm bg-success-light"  href="'.BASE_PATH.'doctor/patient/'.$patient['id'].'/">
                                                <i class="fe fe-eye"></i> View
                                            </a>
                                            <a  href="?d='.$patient['id'].'&sub=sp" class="btn btn-sm bg-danger-light">
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
<script>

    function change_status(st,id) {
        window.location="?sub="+st+"&d="+id;
    }

</script>

