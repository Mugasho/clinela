<?php
$db = new \clinela\database\DB();
$search = isset($_GET['s']) ? filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING) : '';
$clinics = $db->getAllClinics(false,$search);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <a href="#add_clinic" class="btn btn-primary" data-toggle="modal">Add Clinic</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Clinic name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Author</th>
                            <th>Created Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($clinics)) {
                            foreach ($clinics as $clinic) {
                                $user = $db->getUserMeta($clinic['user_id']);
                                $img = !empty($clinic['clinic_image']) ? CONTENT_PATH . 'uploads/' . $clinic['clinic_image'] : CONTENT_PATH . 'public/img/blog/blog-01.jpg';
                                echo ' <tr>
                                <td><a href="' . BASE_PATH . 'clinics/' . $clinic['id'] . '/">#' . $clinic['id'] . '</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="' . BASE_PATH . 'user/' . $user['id'] . '/" class="avatar avatar-sm mr-2"><img class="avatar-img" src="' . $img . '" alt="User Image"></a>
                                        <a href="' . BASE_PATH . 'clinics/' . $clinic['id'] . '/">' . $clinic['clinic'] . '</a>
                                    </h2>
                                </td>
                                <td>' . $clinic['address'] . '</td>
                                <td>' . $clinic['phone'] . '</td>
                                <td>' . $user['username'] . '</td>
                                <td>' . date("j - M Y", strtotime($clinic['created_at'])) . '</td>

                                <td class="text-right">
                                    <div class="actions">

                                        <a  href="' . BASE_PATH . 'admin/edit-clinic/' . $clinic['id'] . '/" class="btn btn-sm bg-success-light mr-2">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a class="btn btn-sm bg-danger-light"  href="?d=' . $clinic['id'] . '&sub=cl">
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

<div class="modal  fade show" id="add_clinic" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Clinic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row form-row">
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Clinic Name</label>
                                <input type="text" class="form-control" name="clinic">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="clinic_image">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Clinic Details</label>
                                <textarea class="form-control" rows="4" name="details"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>