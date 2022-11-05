<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.trainings.index') }}">
                        <i class="mdi mdi-dumbbell"></i>
                        <span> Trainings </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.classes.index') }}">
                        <i class="mdi mdi-book"></i>
                        <span> Classes </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.subscription_categories.index') }}">
                        <i class="mdi mdi-layers-outline"></i>
                        <span> Subscription Categories </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.subscriptions.index') }}">
                        <i class="mdi mdi-book"></i>
                        <span> Subscriptions </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.products.index') }}">
                        <i class="mdi mdi-gift"></i>
                        <span> Products </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
