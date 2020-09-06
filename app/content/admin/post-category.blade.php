<?php
        $db=new \clinela\database\DB();
        $categories=$db->getPostCategories();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="col-sm-12">
                    <a href="#Add_categories_details" data-toggle="modal" class="btn btn-primary float-right mb-1">Add New</a>
                </div>
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Date Added</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($categories)) {
                            foreach ($categories as $category){
                                $img=!empty($category['category_image'])?CONTENT_PATH.'uploads/'.$category['category_image']:CONTENT_PATH.'public/img/patients/patient.jpg';
                                echo '<tr>
                                <td>#'.$category['id'].'</td>

                                <td>
                                    <h2 class="table-avatar">
                                        <a href="profile.html" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img" src="'.$img.'" alt="category">
                                        </a>
                                        <a href="profile.html">'.$category['category'].'</a>
                                    </h2>
                                </td>
                                <td>'.date("j M Y",strtotime($category['created_at'])).'</td>
                                <td class="text-right">
                                    <div class="actions">
                                        <a class="btn btn-sm bg-success-light" data-toggle="modal" href="#edit_categories_details">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a  href="?d='.$category['id'].'&sub=sp" class="btn btn-sm bg-danger-light">
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
<div class="modal fade" id="Add_categories_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>categories</label>
                                <input type="text" class="form-control" name="category">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"  class="form-control" name="category_image">
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

<!-- Edit Details Modal -->
<div class="modal fade" id="edit_categories_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row form-row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>categories</label>
                                <input type="text" class="form-control" value="Cardiology">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file"  class="form-control">
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Details Modal -->

<!-- Delete Modal -->
<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <!--	<div class="modal-header">
                    <h5 class="modal-title">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>-->
            <div class="modal-body">
                <div class="form-content p-2">
                    <h4 class="modal-title">Delete</h4>
                    <p class="mb-4">Are you sure want to delete?</p>
                    <button type="button" class="btn btn-primary">Save </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Modal -->