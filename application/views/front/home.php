<?php $this->load->view('front/header'); ?>
<div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo base_url('public/images/slide1.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('public/images/slide2.jpg') ?>" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo base_url('public/images/slide3.jpg') ?>" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container pt-4 pb-4">
    <h3 class="pb-3">About Company</h3>
    <p class="text-muted"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Animi, deleniti fugit optio
        nisi sapiente
        aliquam
        vero
        delectus. Earum sint nesciunt laudantium quo, eaque, fugiat rerum explicabo reiciendis voluptas magni
        repellendus cupiditate, veniam dolore? Laborum enim aperiam minima tenetur modi tempore. Nisi itaque quam ea
        magni molestias! Maxime ex porro similique.</p>
    <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum odit quam fugit,
        possimus excepturi
        laudantium
        magni itaque similique asperiores nobis repudiandae! Culpa nam fuga provident quae possimus tenetur ullam
        consequatur? Minus sunt molestias fugiat eligendi dignissimos est odit totam optio expedita ratione, saepe
        culpa
        ea blanditiis quo, at dolore rerum numquam? Perferendis obcaecati vitae labore sequi, nisi voluptates
        quaerat
        illo facere facilis accusantium eveniet tempore accusamus qui soluta quisquam autem corrupti reprehenderit
        corporis in aspernatur aliquam! Autem, quis odio. Animi?</p>
</div>
<div class="bg-light pb-4">
    <div class="container">
        <h3 class="pb-3 pt-4">Our Services</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box1.jpg') ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Website Development</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <img src=" <?php echo base_url('public/images/box2.jpg') ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Digital Marketing</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box3.jpg') ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Mobile App Development</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?php echo base_url('public/images/box4.jpg') ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">IT Consulting Services</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
<?php if (!empty($articles)) { ?>
    <div class="pb-4 pt-4">
        <div class="container">
            <h3 class="pb-3 pt-4">Latest Blogs</h3>
            <div class="row">
                <?php foreach ($articles as $article) { ?>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <?php if (file_exists('./public/uploads/articles/thumb_admin/' . $article['image'])) { ?>
                                <img src="<?php echo base_url('public/uploads/articles/thumb_admin/' . $article['image']) ?>" class="card-img-top" alt="...">
                            <?php } ?>

                            <div class="card-body">
                                <p class="card-text"><?php echo $article['title'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } else { ?>

<?php } ?>
<?php $this->load->view('front/footer') ?>