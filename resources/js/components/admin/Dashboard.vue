<template>
    <div id="wrapper" class="border-top border-primary">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">
                    <router-link :to="{name: 'Home'}" tag="li">
                        Instantclass <sup>1.0 </sup>

                    </router-link>


                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a href="#" class="nav-link" @click="component='Home'">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Payments
            </div>

            <!-- Nav Item - Pages Collapse reservation -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa fa-dollar"></i>
                    <span>Payments</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Choisir:</h6>
                        <a class="collapse-item" href="#received" @click="component='Received'">Received</a>
                        <a class="collapse-item" href="#sent" @click="component='Sent'">Sent</a>
                        <a class="collapse-item" href="#Pay" @click="component='NewPayment'">New</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Users
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                   aria-expanded="true" aria-controls="collapsPages">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Choisir:</h6>
                        <a class="collapse-item" href="#teachers" @click="component='Teachers'">Techers</a>
                        <a class="collapse-item" href="#students" @click="component='Students'">Students</a>
                        <a class="collapse-item" href="#admins" @click="component='Admins'">Admins</a>

                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Categories
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                   aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-archive"></i>
                    <span>Categories</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" aria-controls="collapseOne"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Choisir:</h6>

                        <a class="collapse-item" href="#categories" @click="component='Categories'">All categories</a>
                        <a class="collapse-item" href="#">New category</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Courses
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourses"
                   aria-expanded="true" aria-controls="collapseCourses">
                    <i class="fa fa-book"></i>
                    <span>Courses</span>
                </a>
                <div id="collapseCourses" class="collapse" aria-labelledby="headingOne" aria-controls="collapseOne"
                     data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Choisir:</h6>

                        <a class="collapse-item" href="#courses" @click="component='Courses'">List</a>
                        <a class="collapse-item" href="#statistics" @click="component='Statistics'">Statistics</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Search -->
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <h2>
                            Instantclass Administration
                        </h2>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block">

                        </div>
                        <button class="btn btn-danger" @click="logout">
                            Logout
                        </button>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <component v-bind:is="component"/>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
</template>

<script>
    import Teachers from "./users/Teachers";
    import Students from "./users/Students";
    import Admins from "./users/Admins";

    import Received from "./payments/Received";
    import Sent from "./payments/Sent";
    import NewPayment from "./payments/NewPayment";

    import Courses from "./courses/Courses";
    import Statistics from "./courses/Statistics";

    import Categories from "./categories/Categories";
    import Home from "./Home";

    export default {
        name: "Dashboard",
        components: {
            Teachers,
            Students,
            Admins,
            Received,
            Sent,
            NewPayment,
            Courses,
            Statistics,
            Categories,
            Home,
        },
        data() {
            return {
                component: "Home"
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            }
        }
    }
</script>

<style scoped>


    .dropdown .dropdown-menu {
        font-size: .85rem
    }

    .dropdown .dropdown-menu .dropdown-header {
        font-weight: 800;
        font-size: .65rem;
        color: #b7b9cc
    }

    .dropdown.no-arrow .dropdown-toggle::after {
        display: none
    }

    .sidebar .nav-item.dropdown .dropdown-toggle::after, .topbar .nav-item.dropdown .dropdown-toggle::after {
        width: 1rem;
        text-align: center;
        float: right;
        vertical-align: 0;
        border: 0;
        font-weight: 900;
        content: '\f105';
        font-family: 'Font Awesome 5 Free'
    }

    .sidebar .nav-item.dropdown.show .dropdown-toggle::after, .topbar .nav-item.dropdown.show .dropdown-toggle::after {
        content: '\f107'
    }

    .sidebar .nav-item .nav-link, .topbar .nav-item .nav-link {
        position: relative
    }

    .sidebar .nav-item .nav-link .badge-counter, .topbar .nav-item .nav-link .badge-counter {
        position: absolute;
        transform: scale(.7);
        transform-origin: top right;
        right: .25rem;
        margin-top: -.25rem
    }

    .sidebar .nav-item .nav-link .img-profile, .topbar .nav-item .nav-link .img-profile {
        height: 2rem;
        width: 2rem
    }

    .topbar {
        height: 4.375rem
    }

    .topbar #sidebarToggleTop {
        height: 2.5rem;
        width: 2.5rem
    }

    .topbar #sidebarToggleTop:hover {
        background-color: #eaecf4
    }

    .topbar #sidebarToggleTop:active {
        background-color: #dddfeb
    }

    .topbar .navbar-search {
        width: 25rem
    }

    .topbar .navbar-search input {
        font-size: .85rem;
        height: auto
    }

    .topbar .topbar-divider {
        width: 0;
        border-right: 1px solid #e3e6f0;
        height: calc(4.375rem - 2rem);
        margin: auto 1rem
    }

    .topbar .nav-item .nav-link {
        height: 4.375rem;
        display: flex;
        align-items: center;
        padding: 0 .75rem
    }

    .topbar .nav-item .nav-link:focus {
        outline: 0
    }

    .topbar .nav-item:focus {
        outline: 0
    }

    .topbar .dropdown {
        position: static
    }

    .topbar .dropdown .dropdown-menu {
        width: calc(100% - 1.5rem);
        right: .75rem
    }

    .topbar .dropdown-list {
        padding: 0;
        border: none;
        overflow: hidden
    }

    .topbar .dropdown-list .dropdown-header {
        background-color: #4e73df;
        border: 1px solid #4e73df;
        padding-top: .75rem;
        padding-bottom: .75rem;
        color: #fff
    }

    .topbar .dropdown-list .dropdown-item {
        white-space: normal;
        padding-top: .5rem;
        padding-bottom: .5rem;
        border-left: 1px solid #e3e6f0;
        border-right: 1px solid #e3e6f0;
        border-bottom: 1px solid #e3e6f0;
        line-height: 1.3rem
    }

    .topbar .dropdown-list .dropdown-item .dropdown-list-image {
        position: relative;
        height: 2.5rem;
        width: 2.5rem
    }

    .topbar .dropdown-list .dropdown-item .dropdown-list-image img {
        height: 2.5rem;
        width: 2.5rem
    }

    .topbar .dropdown-list .dropdown-item .dropdown-list-image .status-indicator {
        background-color: #eaecf4;
        height: .75rem;
        width: .75rem;
        border-radius: 100%;
        position: absolute;
        bottom: 0;
        right: 0;
        border: .125rem solid #fff
    }

    .topbar .dropdown-list .dropdown-item .text-truncate {
        max-width: 10rem
    }

    .topbar .dropdown-list .dropdown-item:active {
        background-color: #eaecf4;
        color: #3a3b45
    }

    @media (min-width: 576px) {
        .topbar .dropdown {
            position: relative
        }

        .topbar .dropdown .dropdown-menu {
            width: auto;
            right: 0
        }

        .topbar .dropdown-list {
            width: 20rem !important
        }

        .topbar .dropdown-list .dropdown-item .text-truncate {
            max-width: 13.375rem
        }
    }

    .topbar.navbar-light .navbar-nav .nav-item .nav-link {
        color: #d1d3e2
    }

    .topbar.navbar-light .navbar-nav .nav-item .nav-link:hover {
        color: #b7b9cc
    }

    .topbar.navbar-light .navbar-nav .nav-item .nav-link:active {
        color: #858796
    }

    .sidebar {
        width: 6.5rem;
        min-height: 100vh
    }

    .sidebar .nav-item {
        position: relative
    }

    .sidebar .nav-item:last-child {
        margin-bottom: 1rem
    }

    .sidebar .nav-item .nav-link {
        text-align: center;
        padding: .75rem 1rem;
        width: 6.5rem
    }

    .sidebar .nav-item .nav-link span {
        font-size: .65rem;
        display: block
    }

    .sidebar .nav-item.active .nav-link {
        font-weight: 700
    }

    .sidebar .nav-item .collapse {
        position: absolute;
        left: calc(6.5rem + 1.5rem / 2);
        z-index: 1;
        top: 2px
    }

    .sidebar .nav-item .collapse .collapse-inner {
        border-radius: .35rem;
        box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15)
    }

    .sidebar .nav-item .collapsing {
        display: none;
        transition: none
    }

    .sidebar .nav-item .collapse .collapse-inner, .sidebar .nav-item .collapsing .collapse-inner {
        padding: .5rem 0;
        min-width: 10rem;
        font-size: .85rem;
        margin: 0 0 1rem 0
    }

    .sidebar .nav-item .collapse .collapse-inner .collapse-header, .sidebar .nav-item .collapsing .collapse-inner .collapse-header {
        margin: 0;
        white-space: nowrap;
        padding: .5rem 1.5rem;
        text-transform: uppercase;
        font-weight: 800;
        font-size: .65rem;
        color: #b7b9cc
    }

    .sidebar .nav-item .collapse .collapse-inner .collapse-item, .sidebar .nav-item .collapsing .collapse-inner .collapse-item {
        padding: .5rem 1rem;
        margin: 0 .5rem;
        display: block;
        color: #3a3b45;
        text-decoration: none;
        border-radius: .35rem;
        white-space: nowrap
    }

    .sidebar .nav-item .collapse .collapse-inner .collapse-item:hover, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:hover {
        background-color: #eaecf4
    }

    .sidebar .nav-item .collapse .collapse-inner .collapse-item:active, .sidebar .nav-item .collapsing .collapse-inner .collapse-item:active {
        background-color: #dddfeb
    }

    .sidebar .nav-item .collapse .collapse-inner .collapse-item.active, .sidebar .nav-item .collapsing .collapse-inner .collapse-item.active {
        color: #4e73df;
        font-weight: 700
    }

    .sidebar #sidebarToggle {
        width: 2.5rem;
        height: 2.5rem;
        text-align: center;
        margin-bottom: 1rem;
        cursor: pointer
    }

    .sidebar #sidebarToggle::after {
        font-weight: 900;
        content: '\f104';
        font-family: 'Font Awesome 5 Free';
        margin-right: .1rem
    }

    .sidebar #sidebarToggle:hover {
        text-decoration: none
    }

    .sidebar #sidebarToggle:focus {
        outline: 0
    }

    .sidebar.toggled {
        width: 0 !important;
        overflow: hidden
    }

    .sidebar.toggled #sidebarToggle::after {
        content: '\f105';
        font-family: 'Font Awesome 5 Free';
        margin-left: .25rem
    }

    .sidebar .sidebar-brand {
        height: 4.375rem;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 800;
        padding: 1.5rem 1rem;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: .05rem;
        z-index: 1
    }

    .sidebar .sidebar-brand .sidebar-brand-icon i {
        font-size: 2rem
    }

    .sidebar .sidebar-brand .sidebar-brand-text {
        display: none
    }

    .sidebar hr.sidebar-divider {
        margin: 0 1rem 1rem
    }

    .sidebar .sidebar-heading {
        text-align: center;
        padding: 0 1rem;
        font-weight: 800;
        font-size: .65rem
    }

    @media (min-width: 768px) {
        .sidebar {
            width: 14rem !important
        }

        .sidebar .nav-item .collapse {
            position: relative;
            left: 0;
            z-index: 1;
            top: 0;
            -webkit-animation: none;
            animation: none
        }

        .sidebar .nav-item .collapse .collapse-inner {
            border-radius: 0;
            box-shadow: none
        }

        .sidebar .nav-item .collapsing {
            display: block;
            transition: height .15s ease
        }

        .sidebar .nav-item .collapse, .sidebar .nav-item .collapsing {
            margin: 0 1rem
        }

        .sidebar .nav-item .nav-link {
            display: block;
            width: 100%;
            text-align: left;
            padding: 1rem;
            width: 14rem
        }

        .sidebar .nav-item .nav-link i {
            font-size: .85rem;
            margin-right: .25rem
        }

        .sidebar .nav-item .nav-link span {
            font-size: .85rem;
            display: inline
        }

        .sidebar .nav-item .nav-link[data-toggle=collapse]::after {
            width: 1rem;
            text-align: center;
            float: right;
            vertical-align: 0;
            border: 0;
            font-weight: 900;
            content: '\f107';
            font-family: 'Font Awesome 5 Free'
        }

        .sidebar .nav-item .nav-link[data-toggle=collapse].collapsed::after {
            content: '\f105'
        }

        .sidebar .sidebar-brand .sidebar-brand-icon i {
            font-size: 2rem
        }

        .sidebar .sidebar-brand .sidebar-brand-text {
            display: inline
        }

        .sidebar .sidebar-heading {
            text-align: left
        }

        .sidebar.toggled {
            overflow: visible;
            width: 6.5rem !important
        }

        .sidebar.toggled .nav-item .collapse {
            position: absolute;
            left: calc(6.5rem + 1.5rem / 2);
            z-index: 1;
            top: 2px;
            -webkit-animation-name: growIn;
            animation-name: growIn;
            -webkit-animation-duration: .2s;
            animation-duration: .2s;
        }

        .sidebar.toggled .nav-item .collapse .collapse-inner {
            box-shadow: 0 .15rem 1.75rem 0 rgba(58, 59, 69, .15);
            border-radius: .35rem
        }

        .sidebar.toggled .nav-item .collapsing {
            display: none;
            transition: none
        }

        .sidebar.toggled .nav-item .collapse, .sidebar.toggled .nav-item .collapsing {
            margin: 0
        }

        .sidebar.toggled .nav-item:last-child {
            margin-bottom: 1rem
        }

        .sidebar.toggled .nav-item .nav-link {
            text-align: center;
            padding: .75rem 1rem;
            width: 6.5rem
        }

        .sidebar.toggled .nav-item .nav-link span {
            font-size: .65rem;
            display: block
        }

        .sidebar.toggled .nav-item .nav-link i {
            margin-right: 0
        }

        .sidebar.toggled .nav-item .nav-link[data-toggle=collapse]::after {
            display: none
        }

        .sidebar.toggled .sidebar-brand .sidebar-brand-icon i {
            font-size: 2rem
        }

        .sidebar.toggled .sidebar-brand .sidebar-brand-text {
            display: none
        }

        .sidebar.toggled .sidebar-heading {
            text-align: center
        }
    }

    .sidebar-light .sidebar-brand {
        color: #6e707e
    }

    .sidebar-light hr.sidebar-divider {
        border-top: 1px solid #eaecf4
    }

    .sidebar-light .sidebar-heading {
        color: #b7b9cc
    }

    .sidebar-light .nav-item .nav-link {
        color: #858796
    }

    .sidebar-light .nav-item .nav-link i {
        color: #d1d3e2
    }

    .sidebar-light .nav-item .nav-link:active, .sidebar-light .nav-item .nav-link:focus, .sidebar-light .nav-item .nav-link:hover {
        color: #6e707e
    }

    .sidebar-light .nav-item .nav-link:active i, .sidebar-light .nav-item .nav-link:focus i, .sidebar-light .nav-item .nav-link:hover i {
        color: #6e707e
    }

    .sidebar-light .nav-item .nav-link[data-toggle=collapse]::after {
        color: #b7b9cc
    }

    .sidebar-light .nav-item.active .nav-link {
        color: #6e707e
    }

    .sidebar-light .nav-item.active .nav-link i {
        color: #6e707e
    }

    .sidebar-light #sidebarToggle {
        background-color: #eaecf4
    }

    .sidebar-light #sidebarToggle::after {
        color: #b7b9cc
    }

    .sidebar-light #sidebarToggle:hover {
        background-color: #dddfeb
    }

    .sidebar-dark .sidebar-brand {
        color: #fff
    }

    .sidebar-dark hr.sidebar-divider {
        border-top: 1px solid rgba(255, 255, 255, .15)
    }

    .sidebar-dark .sidebar-heading {
        color: rgba(255, 255, 255, .4)
    }

    .sidebar-dark .nav-item .nav-link {
        color: rgba(255, 255, 255, .8)
    }

    .sidebar-dark .nav-item .nav-link i {
        color: rgba(255, 255, 255, .3)
    }

    .sidebar-dark .nav-item .nav-link:active, .sidebar-dark .nav-item .nav-link:focus, .sidebar-dark .nav-item .nav-link:hover {
        color: #fff
    }

    .sidebar-dark .nav-item .nav-link:active i, .sidebar-dark .nav-item .nav-link:focus i, .sidebar-dark .nav-item .nav-link:hover i {
        color: #fff
    }

    .sidebar-dark .nav-item .nav-link[data-toggle=collapse]::after {
        color: rgba(255, 255, 255, .5)
    }

    .sidebar-dark .nav-item.active .nav-link {
        color: #fff
    }

    .sidebar-dark .nav-item.active .nav-link i {
        color: #fff
    }

    .sidebar-dark #sidebarToggle {
        background-color: rgba(255, 255, 255, .2)
    }

    .sidebar-dark #sidebarToggle::after {
        color: rgba(255, 255, 255, .5)
    }

    .sidebar-dark #sidebarToggle:hover {
        background-color: rgba(255, 255, 255, .25)
    }

    .sidebar-dark.toggled #sidebarToggle::after {
        color: rgba(255, 255, 255, .5)
    }


    #wrapper {
        display: flex
    }

    #wrapper #content-wrapper {
        background-color: #f8f9fc;
        width: 100%;
        overflow-x: hidden
    }

    #wrapper #content-wrapper #content {
        flex: 1 0 auto
    }

    .sidebar .nav-item .nav-link[data-toggle=collapse]::after {
        width: 1rem;
        text-align: center;
        float: right;
        vertical-align: 0;
        border: 0;
        font-weight: 900;
        content: '\f107';
        font-family: 'Font Awesome 5 Free'
    }

    .sidebar .nav-item .nav-link[data-toggle=collapse].collapsed::after {
        content: '\f105'
    }

</style>
