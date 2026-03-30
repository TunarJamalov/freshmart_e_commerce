<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin_dashboard') }}">Admin Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin_dashboard') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

            <li class="nav-item dropdown {{ Request::is('admin/setting/logo') || Request::is('admin/setting/favicon') || Request::is('admin/setting/top-bar') || Request::is('admin/setting/footer') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Manage Setting</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/setting/logo') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting_logo') }}"><i class="fas fa-angle-right"></i> Logo</a></li>
                    <li class="{{ Request::is('admin/setting/favicon') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting_favicon') }}"><i class="fas fa-angle-right"></i> Favicon</a></li>
                    <li class="{{ Request::is('admin/setting/top-bar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting_top_bar') }}"><i class="fas fa-angle-right"></i> Top Bar</a></li>
                    <li class="{{ Request::is('admin/setting/footer') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_setting_footer') }}"><i class="fas fa-angle-right"></i> Footer</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/product-category/*') || Request::is('admin/product/*') || Request::is('admin/coupon/*') || Request::is('admin/delivery-option/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Manage Product</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/product-category/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_product_category_index') }}"><i class="fas fa-angle-right"></i> Categories</a></li>
                    <li class="{{ Request::is('admin/product/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_product_index') }}"><i class="fas fa-angle-right"></i> Product</a></li>
                    <li class="{{ Request::is('admin/coupon/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_coupon_index') }}"><i class="fas fa-angle-right"></i> Coupon</a></li>
                    <li class="{{ Request::is('admin/delivery-option/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_delivery_option_index') }}"><i class="fas fa-angle-right"></i> Delivery Option</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown {{ Request::is('admin/page/privacy/*') || Request::is('admin/page/terms/*') || Request::is('admin/page/contact/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-folder"></i><span>Manage Page Content</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/privacy/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_privacy') }}"><i class="fas fa-angle-right"></i> Privacy Page</a></li>
                    <li class="{{ Request::is('admin/page/terms/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_terms') }}"><i class="fas fa-angle-right"></i> Terms Page</a></li>
                    <li class="{{ Request::is('admin/page/contact/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_page_contact') }}"><i class="fas fa-angle-right"></i> Contact Page</a></li>
                </ul>
            </li>
            

            <li class="{{ Request::is('admin/user/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_user_index') }}"><i class="far fa-file"></i> <span>Manage User</span></a></li>

            <li class="{{ Request::is('admin/subscriber/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_subscriber_index') }}"><i class="far fa-file"></i> <span>Manage Subscribers</span></a></li>

            <li class="{{ Request::is('admin/order/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_order_index') }}"><i class="far fa-file"></i> <span>Orders</span></a></li>

            <li class="{{ Request::is('admin/rating/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_rating_index') }}"><i class="far fa-file"></i> <span>Ratings</span></a></li>

            <li class="{{ Request::is('admin/slider/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_slider_index') }}"><i class="far fa-file"></i> <span>Sliders</span></a></li>

            <li class="{{ Request::is('admin/faq/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_faq_index') }}"><i class="far fa-file"></i> <span>FAQs</span></a></li>

            <li class="{{ Request::is('admin/post/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_post_index') }}"><i class="far fa-file"></i> <span>Posts</span></a></li>

            <li class="{{ Request::is('admin/comments') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin_comment') }}"><i class="far fa-file"></i> <span>Comments</span></a></li>


        </ul>
    </aside>
</div>