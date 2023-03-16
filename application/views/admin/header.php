<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>CiBlig-Admin Panel</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>public/admin/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        Welcome, <strong>Admin</strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo base_url() . '/admin/Login/logout' ?>" class="dropdown-item">
                            Logout
                        </a>

                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link bg-white">
                <span class="brand-text ml-5"><strong>CiBlog</strong></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <p>
                                    <i class="far fa-circle nav-icon"></i>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li
                            class="nav-item has-treeview  <?php echo (!empty($mainModule) && $mainModule == "category") ? 'menu-open' : ''?>">
                            <a href="" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'admin/Category/create';?>"
                                        class="nav-link  <?php echo (!empty($mainModule) && $mainModule == "category" && !empty($subModule) && $subModule == "createCategory") ? 'active' : ''?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Cateogry</p>
                                    </a>
                                </li>
                                <li
                                    class="nav-item <?php echo (!empty($mainModule) && $mainModule == "category" && !empty($subModule) && $subModule == "viewCategory") ? 'active' : ''?>">
                                    <a href="<?php echo base_url().'admin/Category/index';?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Category</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="nav-item has-treeview <?php echo (!empty($mainModule) && $mainModule == "article") ? 'menu-open' : ''?>">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Articles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'admin/Article/create';?>"
                                        class="nav-link <?php echo (!empty($mainModule) && $mainModule == "article" && !empty($subModule) && $subModule == "createArticle") ? 'active' : ''?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Article</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'admin/Article/index';?>"
                                        class="nav-link  <?php echo (!empty($mainModule) && $mainModule == "article" && !empty($subModule) && $subModule == "viewArticle") ? 'active' : ''?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Article</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Simple Link
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">