<?php
        $db=new \clinela\database\DB();
        $specialities=$db->getSpecialities();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="col-sm-12">
                    <a href="#Add_Specialities_details" data-toggle="modal" class="btn btn-primary float-right mb-1">Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>Specialities</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($specialities)) {
                            foreach ($specialities as $speciality){
                                $img=!empty($speciality['speciality_image'])?CONTENT_PATH.'uploads/'.$speciality['speciality_image']:CONTENT_PATH.'admin/img/specialities/specialities-01.png';
                                echo '<tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="'.$img.'" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img" src="'.$img.'" alt="Speciality">
                                        </a>
                                        <a href="'.$speciality['id'].'">'.$speciality['speciality'].'</a>
                                    </h2>
                                </td>

                                <td class="text-right">
                                    <div class="actions">
                                        <a  href="?d='.$speciality['id'].'&sub=sp" class="btn btn-sm bg-danger-light">
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

<!-- Add Modal -->
<div class="modal fade" id="Add_Specialities_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Specialities</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Specialities</label>
                                <input type="text" class="form-control" name="speciality">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"  class="form-control" name="speciality_image">
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /ADD Modal -->
