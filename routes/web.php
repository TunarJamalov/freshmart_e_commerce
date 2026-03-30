<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminDeliveryOptionController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminRatingController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminSettingController;

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontController::class, 'contact_submit'])->name('contact_submit');
Route::get('/faq', [FrontController::class, 'faq'])->name('faq');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/post/{slug}', [FrontController::class, 'post'])->name('post');
Route::get('/terms', [FrontController::class, 'terms'])->name('terms');
Route::get('/privacy', [FrontController::class, 'privacy'])->name('privacy');
Route::get('/products', [FrontController::class, 'products'])->name('products');
Route::get('/product/{slug}', [FrontController::class, 'product'])->name('product');
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/cart/add', [FrontController::class, 'cart_add'])->name('cart_add');
Route::post('/cart/update', [FrontController::class, 'cart_update'])->name('cart_update');
Route::get('/cart/remove/{product_variation_id}', [FrontController::class, 'cart_remove'])->name('cart_remove');
Route::get('/cart/clear', [FrontController::class, 'cart_clear'])->name('cart_clear');
Route::post('/apply-coupon', [FrontController::class, 'apply_coupon'])->name('apply_coupon');
Route::get('/remove-coupon/{coupon_id}', [FrontController::class, 'remove_coupon'])->name('remove_coupon');
Route::post('/change-delivery-option', [FrontController::class, 'change_delivery_option'])->name('change_delivery_option');
Route::post('/comment-submit/{post_id}', [FrontController::class, 'comment_submit'])->name('comment_submit');
Route::post('/reply-submit/{comment_id}', [FrontController::class, 'reply_submit'])->name('reply_submit');

Route::post('/payment', [FrontController::class, 'payment'])->name('payment');
Route::get('/paypal/success', [FrontController::class, 'paypal_success'])->name('paypal_success');
Route::get('/paypal/cancel', [FrontController::class, 'paypal_cancel'])->name('paypal_cancel');
Route::get('/stripe/success', [FrontController::class, 'stripe_success'])->name('stripe_success');
Route::get('/stripe/cancel', [FrontController::class, 'stripe_cancel'])->name('stripe_cancel');

Route::post('/subscriber/send-email', [FrontController::class, 'subscriber_send_email'])->name('subscriber_send_email');
Route::get('/subscriber/verify/{email}/{token}', [FrontController::class, 'subscriber_verify'])->name('subscriber_verify');

// User
Route::middleware('auth')->prefix('user')->group(function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user_dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user_profile');
    Route::post('/profile', [UserController::class, 'profile_submit'])->name('user_profile_submit');
    Route::get('/orders', [UserController::class, 'orders'])->name('user_orders');
    Route::get('/invoice/{order_no}', [UserController::class, 'invoice'])->name('user_invoice');
    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('user_wishlist');
    Route::get('/wishlist/add/{product_id}', [UserController::class, 'wishlist_add'])->name('user_wishlist_add');
    Route::get('/wishlist/remove/{id}', [UserController::class, 'wishlist_remove'])->name('user_wishlist_remove');
    Route::post('/rating/submit/{product_id}', [UserController::class, 'rating_submit'])->name('rating_submit');
});
Route::prefix('user')->group(function(){
    Route::get('/registration', [UserController::class, 'registration'])->name('user_registration');
    Route::post('/registration', [UserController::class, 'registration_submit'])->name('user_registration_submit');
    Route::get('/registration-verify/{token}/{email}', [UserController::class, 'registration_verify'])->name('user_registration_verify');
    Route::get('/login', [UserController::class, 'login'])->name('user_login');
    Route::post('/login', [UserController::class, 'login_submit'])->name('user_login_submit');
    Route::get('/forget-password', [UserController::class, 'forget_password'])->name('user_forget_password');
    Route::post('/forget-password', [UserController::class, 'forget_password_submit'])->name('user_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [UserController::class, 'reset_password'])->name('user_reset_password');
    Route::post('/reset-password/{token}/{email}', [UserController::class, 'reset_password_submit'])->name('user_reset_password_submit');
    Route::get('/logout', [UserController::class, 'logout'])->name('user_logout');
});


// Admin
Route::middleware('admin')->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminController::class, 'profile_submit'])->name('admin_profile_submit');

    Route::get('/user/index', [AdminUserController::class, 'index'])->name('admin_user_index');
    Route::get('/user/create', [AdminUserController::class, 'create'])->name('admin_user_create');
    Route::post('/user/store', [AdminUserController::class, 'store'])->name('admin_user_store');
    Route::get('/user/edit/{id}', [AdminUserController::class, 'edit'])->name('admin_user_edit');
    Route::post('/user/update/{id}', [AdminUserController::class, 'update'])->name('admin_user_update');
    Route::get('/user/delete/{id}', [AdminUserController::class, 'delete'])->name('admin_user_delete');

    Route::get('/product-category/index', [AdminProductCategoryController::class, 'index'])->name('admin_product_category_index');
    Route::get('/product-category/create', [AdminProductCategoryController::class, 'create'])->name('admin_product_category_create');
    Route::post('/product-category/store', [AdminProductCategoryController::class, 'store'])->name('admin_product_category_store');
    Route::get('/product-category/edit/{id}', [AdminProductCategoryController::class, 'edit'])->name('admin_product_category_edit');
    Route::post('/product-category/update/{id}', [AdminProductCategoryController::class, 'update'])->name('admin_product_category_update');
    Route::get('/product-category/delete/{id}', [AdminProductCategoryController::class, 'delete'])->name('admin_product_category_delete');

    Route::get('/product/index', [AdminProductController::class, 'index'])->name('admin_product_index');
    Route::get('/product/create', [AdminProductController::class, 'create'])->name('admin_product_create');
    Route::post('/product/store', [AdminProductController::class, 'store'])->name('admin_product_store');
    Route::get('/product/edit/{id}', [AdminProductController::class, 'edit'])->name('admin_product_edit');
    Route::post('/product/update/{id}', [AdminProductController::class, 'update'])->name('admin_product_update');
    Route::get('/product/delete/{id}', [AdminProductController::class, 'delete'])->name('admin_product_delete');
    Route::get('/product/variation/{id}', [AdminProductController::class, 'product_variation'])->name('admin_product_variation');
    Route::post('/product/variation/store/{id}', [AdminProductController::class, 'product_variation_store'])->name('admin_product_variation_store');
    Route::post('/product/variation/update/{id}', [AdminProductController::class, 'product_variation_update'])->name('admin_product_variation_update');
    Route::get('/product/variation/delete/{id}', [AdminProductController::class, 'product_variation_delete'])->name('admin_product_variation_delete');

    Route::get('/product/additional-information/{id}', [AdminProductController::class, 'product_additional_information'])->name('admin_product_additional_information');
    Route::post('/product/additional-information/store/{id}', [AdminProductController::class, 'product_additional_information_store'])->name('admin_product_additional_information_store');
    Route::post('/product/additional-information/update/{id}', [AdminProductController::class, 'product_additional_information_update'])->name('admin_product_additional_information_update');
    Route::get('/product/additional-information/delete/{id}', [AdminProductController::class, 'product_additional_information_delete'])->name('admin_product_additional_information_delete');

    Route::get('/coupon/index', [AdminCouponController::class, 'index'])->name('admin_coupon_index');
    Route::get('/coupon/create', [AdminCouponController::class, 'create'])->name('admin_coupon_create');
    Route::post('/coupon/store', [AdminCouponController::class, 'store'])->name('admin_coupon_store');
    Route::get('/coupon/edit/{id}', [AdminCouponController::class, 'edit'])->name('admin_coupon_edit');
    Route::post('/coupon/update/{id}', [AdminCouponController::class, 'update'])->name('admin_coupon_update');
    Route::get('/coupon/delete/{id}', [AdminCouponController::class, 'delete'])->name('admin_coupon_delete');

    Route::get('/delivery-option/index', [AdminDeliveryOptionController::class, 'index'])->name('admin_delivery_option_index');
    Route::get('/delivery-option/create', [AdminDeliveryOptionController::class, 'create'])->name('admin_delivery_option_create');
    Route::post('/delivery-option/store', [AdminDeliveryOptionController::class, 'store'])->name('admin_delivery_option_store');
    Route::get('/delivery-option/edit/{id}', [AdminDeliveryOptionController::class, 'edit'])->name('admin_delivery_option_edit');
    Route::post('/delivery-option/update/{id}', [AdminDeliveryOptionController::class, 'update'])->name('admin_delivery_option_update');
    Route::get('/delivery-option/delete/{id}', [AdminDeliveryOptionController::class, 'delete'])->name('admin_delivery_option_delete');

    Route::get('/order/index', [AdminOrderController::class, 'index'])->name('admin_order_index');
    Route::get('/order/invoice/{order_no}', [AdminOrderController::class, 'invoice'])->name('admin_order_invoice');
    Route::get('/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('admin_order_delete');
    Route::get('/order/change-payment-status/{id}', [AdminOrderController::class, 'change_payment_status'])->name('admin_order_change_payment_status');
    Route::post('/order/change-delivery-status/{id}', [AdminOrderController::class, 'change_delivery_status'])->name('admin_order_change_delivery_status');

    Route::get('/rating/index', [AdminRatingController::class, 'index'])->name('admin_rating_index');
    Route::get('/rating/delete/{id}', [AdminRatingController::class, 'delete'])->name('admin_rating_delete');

    Route::get('/slider/index', [AdminSliderController::class, 'index'])->name('admin_slider_index');
    Route::get('/slider/create', [AdminSliderController::class, 'create'])->name('admin_slider_create');
    Route::post('/slider/store', [AdminSliderController::class, 'store'])->name('admin_slider_store');
    Route::get('/slider/edit/{id}', [AdminSliderController::class, 'edit'])->name('admin_slider_edit');
    Route::post('/slider/update/{id}', [AdminSliderController::class, 'update'])->name('admin_slider_update');
    Route::get('/slider/delete/{id}', [AdminSliderController::class, 'delete'])->name('admin_slider_delete');

    Route::get('/faq/index', [AdminFaqController::class, 'index'])->name('admin_faq_index');
    Route::get('/faq/create', [AdminFaqController::class, 'create'])->name('admin_faq_create');
    Route::post('/faq/store', [AdminFaqController::class, 'store'])->name('admin_faq_store');
    Route::get('/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('admin_faq_edit');
    Route::post('/faq/update/{id}', [AdminFaqController::class, 'update'])->name('admin_faq_update');
    Route::get('/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('admin_faq_delete');

    Route::get('/post/index', [AdminPostController::class, 'index'])->name('admin_post_index');
    Route::get('/post/create', [AdminPostController::class, 'create'])->name('admin_post_create');
    Route::post('/post/store', [AdminPostController::class, 'store'])->name('admin_post_store');
    Route::get('/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit');
    Route::post('/post/update/{id}', [AdminPostController::class, 'update'])->name('admin_post_update');
    Route::get('/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete');

    Route::get('/comments', [AdminPostController::class, 'comment'])->name('admin_comment');
    Route::get('/comments/status-change/{id}', [AdminPostController::class, 'comment_status_change'])->name('admin_comment_status_change');
    Route::get('/comments/delete/{id}', [AdminPostController::class, 'comment_delete'])->name('admin_comment_delete');

    Route::get('/replies/{comment_id}', [AdminPostController::class, 'reply'])->name('admin_reply');
    Route::get('/replies/status-change/{id}', [AdminPostController::class, 'reply_status_change'])->name('admin_reply_status_change');
    Route::get('/replies/delete/{id}', [AdminPostController::class, 'reply_delete'])->name('admin_reply_delete');
    Route::post('/reply/submit/{comment_id}', [AdminPostController::class, 'admin_reply_submit'])->name('admin_reply_submit');


    Route::get('/subscriber/index', [AdminSubscriberController::class, 'index'])->name('admin_subscriber_index');
    Route::get('/subscriber/export', [AdminSubscriberController::class, 'export'])->name('admin_subscriber_export');
    Route::get('/subscriber/delete/{id}', [AdminSubscriberController::class, 'delete'])->name('admin_subscriber_delete');
    

    Route::get('/page/privacy/index', [AdminPageController::class, 'page_privacy'])->name('admin_page_privacy');
    Route::post('/page/privacy/update', [AdminPageController::class, 'page_privacy_update'])->name('admin_page_privacy_update');

    Route::get('/page/terms/index', [AdminPageController::class, 'page_terms'])->name('admin_page_terms');
    Route::post('/page/terms/update', [AdminPageController::class, 'page_terms_update'])->name('admin_page_terms_update');

    Route::get('/page/contact/index', [AdminPageController::class, 'page_contact'])->name('admin_page_contact');
    Route::post('/page/contact/update', [AdminPageController::class, 'page_contact_update'])->name('admin_page_contact_update');

    Route::get('/setting/logo', [AdminSettingController::class, 'logo'])->name('admin_setting_logo');
    Route::post('/setting/logo/update', [AdminSettingController::class, 'logo_update'])->name('admin_setting_logo_update');

    Route::get('/setting/favicon', [AdminSettingController::class, 'favicon'])->name('admin_setting_favicon');
    Route::post('/setting/favicon/update', [AdminSettingController::class, 'favicon_update'])->name('admin_setting_favicon_update');

    Route::get('/setting/top-bar', [AdminSettingController::class, 'top_bar'])->name('admin_setting_top_bar');
    Route::post('/setting/top-bar/update', [AdminSettingController::class, 'top_bar_update'])->name('admin_setting_top_bar_update');

    Route::get('/setting/footer', [AdminSettingController::class, 'footer'])->name('admin_setting_footer');
    Route::post('/setting/footer/update', [AdminSettingController::class, 'footer_update'])->name('admin_setting_footer_update');
});

Route::prefix('admin')->group(function(){
    Route::get('/', function () {return redirect()->route('admin_login');});
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
});
