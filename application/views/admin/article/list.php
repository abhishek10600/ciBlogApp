<?php $this->load->view('admin/header'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Articles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Articles</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php if ($this->session->flashdata('success') != "") { ?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?> </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error') != "") { ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?> </div>
                <?php } ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <form id="searhFrm" name="searhFrm" method="get" action="">
                                <div class="input-group mb-0">
                                    <input type="text" value="<?php echo $queryString;?>" class="form-control" value=""
                                        placeholder="Search by title or author" name="q">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon1">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="card-tools">
                            <a href="<?php echo base_url() . 'admin/Article/create' ?>" class="btn btn-primary"><i
                                    class="fas fa-plus mx-2"></i>Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th width="50">#</th>
                                <th width="100">Image</th>
                                <th>Title</th>
                                <th width="180">Author</th>
                                <th width="100">Created At</th>
                                <th width="70">Status</th>
                                <th width="140" class="text-center">Action</th>
                            </tr>
                            <?php if(!empty($articles)) {
								foreach($articles as $article){?>
                            <tr>
                                <td><?php echo $article['id']; ?></td>
                                <td>
                                    <?php
											$path='./public/uploads/articles/thumb_admin/'.$article['image']; 
											if($article['image'] != "" && file_exists($path)) {?>
                                    <img class="w-100"
                                        src="<?php echo base_url('public/uploads/articles/thumb_admin/'.$article['image']);?>">
                                    <?php }else{?>
                                    <img width="200"
                                        src="<?php echo base_url('public/uploads/articles/no-image.jpg'.$article['image']);?>">
                                    <?php }?>

                                </td>
                                <td><?php echo $article['title']; ?></td>
                                <td><?php echo $article['author']; ?></td>
                                <td><?php echo date('d-m-Y',strtotime($article['created_at'])); ?></td>
                                <td>
                                    <?php
												if($article['status'] == 1) { ?>
                                    <p class="badge badge-success">Active</p>
                                    <?php } else {?>
                                    <p class="badge badge-danger">Block</p>
                                    <?php }?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url().'admin/Article/edit/'.$article['id'];?>"
                                        class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                    <a href="javascript:void(0);" onClick="deleteArticle(<?php echo $article['id'];?>)"
                                        class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php }?>
                            <?php }else {?>
                            <tr>
                                <td colspan="7">No Records Found</td>
                            </tr>
                            <?php } ?>

                        </table>
                        <div>
                            <?php echo $pagination_links; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('admin/footer'); ?>
<script>
const deleteArticle = (id) => {
    if (confirm("Are you sure you want to delete this article?")) {
        window.location.href = '<?php echo base_url() . 'admin/Article/delete/'; ?>' + id
    }
}
</script>