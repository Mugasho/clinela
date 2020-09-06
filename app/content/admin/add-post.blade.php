<?php
$db=new \clinela\database\DB();
$categories=$db->getPostCategories();
?>
<style>
    .bootstrap-tagsinput {
        border-color: #dcdcdc;
        box-shadow: inherit;
        min-height: 46px;
        width: 100%;
        border-radius: 0;
    }

    .bootstrap-tagsinput .tag {
        background-color: #20c0f3;
        color: #fff;
        display: inline-block;
        font-size: 14px;
        font-weight: normal;
        margin-right: 2px;
        padding: 11px 15px;
        border-radius: 0;
    }


</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form method="post" enctype="multipart/form-data">
            <div class="card-body">

                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label class="col-form-label">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="col-form-label ">Category</label>
                            <select class="form-control" name="category">
                                <option value="0">Uncategorized</option>
                                <?php if (!empty($categories)) {
                                    foreach ($categories as $category){
                                        echo '<option value="'.$category['id'].'">'.$category['category'].'</option>';
                                    }
                                }?>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label class="col-form-label ">Featured Image</label>
                            <input class="form-control" type="file" name="post_image">
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="col-form-label">Post content</label>

                            <textarea rows="5" cols="5" class="form-control summernote" placeholder="Enter text here" name="content"></textarea>

                        </div>
                    </div>

                <div class="form-group">
                    <label class="col-form-label">Tags</label>
                    <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Tags" name="tags" value="" id="tags">
                    <small class="form-text text-muted">Note : Type & Press enter to add new tags</small>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('.summernote').summernote();
</script>
