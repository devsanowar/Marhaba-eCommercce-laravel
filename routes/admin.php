<?php

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\NewslatterController;
use App\Http\Controllers\Admin\SmsSettingController;
use App\Http\Controllers\Admin\SocialIconController;
use App\Http\Controllers\Admin\SocialWorkController;
use App\Http\Controllers\Admin\WhyChoseUsController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\PromobannerController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\WebsiteSettingController;

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        // Dashboard
        Route::get('dashboard', [AdminController::class, 'dasboard'])->name('admin.dashboard');

        // User Management
        Route::prefix('user')->group(function () {
            Route::get('create', [UserController::class, 'userCreate'])->name('user.create');
            Route::post('store', [UserController::class, 'storeUser'])->name('user.store');
            Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit.user');
            Route::post('{id}/update', [UserController::class, 'updateUser'])->name('update.user');
            Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
            Route::post('profile/{id}/image', [UserController::class, 'profileImageUpdate'])->name('update.profile.image');
            Route::post('password/{id}/change', [UserController::class, 'passwordUpdate'])->name('update.password');
            Route::delete('delete/{id}', [UserController::class, 'destroyUser'])->name('user.destroy');
        });

        // Website Settings
        Route::prefix('website')->group(function () {
            Route::get('setting', [WebsiteSettingController::class, 'websiteSetting'])->name('website_setting');

            Route::post('setting/update', [WebsiteSettingController::class, 'websiteSettingUpdate'])->name('website_setting.update');

            Route::post('bredcrumb/update', [WebsiteSettingController::class, 'bredcrumbUpdate'])->name('bredcrumb.update');

            Route::post('google-map/update', [WebsiteSettingController::class, 'googleMapUpdate'])->name('googlemap.update');

            Route::post('footer-info/update', [WebsiteSettingController::class, 'footerInfoSettingUpdate'])->name('website_footer_info.update');

            Route::get('social-icon', [SocialIconController::class, 'socialIcon'])->name('website_social_icon.index');
            Route::post('social-icon/update', [SocialIconController::class, 'socialIconUpdate'])->name('website_social_icon.update');
        });

        // Admin Panel Settings
        Route::prefix('admin-panel')->group(function () {
            Route::get('setting', [AdminPanelController::class, 'adminPanelSetting'])->name('admin_panel_setting');
            Route::post('setting/update', [AdminPanelController::class, 'adminPanelSettingUpdate'])->name('admin_panel_setting.update');
        });

        // Home Page Sections
        Route::prefix('home-page')->group(function () {
            // Sliders
            Route::prefix('slider')->group(function () {
                Route::get('/', [SliderController::class, 'index'])->name('slider.index');
                Route::get('create', [SliderController::class, 'create'])->name('slider.create');
                Route::post('store', [SliderController::class, 'store'])->name('slider.store');
                Route::get('edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
                Route::put('update/{id}', [SliderController::class, 'update'])->name('slider.update');
                Route::delete('destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
            });

            // Brand
            Route::resource('brand', BrandController::class);
            Route::post('/brand/status-change', [BrandController::class, 'brandChangeStatus'])->name('brand.status');

            // About
            Route::get('about', [AboutController::class, 'index'])->name('about.index');
            Route::post('about/update', [AboutController::class, 'update'])->name('about.update');

            // Why chose us
            Route::resource('why-choose-us', WhyChoseUsController::class);

            // Achievement
            Route::resource('achievement', AchievementController::class);

            // Reviews
            Route::resource('review', ReviewController::class);

            // FAQs
            Route::resource('faq', FaqController::class);

            //Banner
            Route::get('banner', [BannerController::class, 'index'])->name('banner.index');
            Route::post('banner/update', [BannerController::class, 'update'])->name('banner.update');

            //Promo banner
            Route::get('/promobanner', [PromobannerController::class, 'index'])->name('promobanner.index');
            Route::post('/promobanner/store', [PromobannerController::class, 'store'])->name('promobanner.store');
            Route::put('/promobanner/update', [PromobannerController::class, 'update'])->name('promobanner.update');
            Route::delete('/promobanner/delete/{id}', [PromobannerController::class, 'destroy'])->name('promobanner.destroy');
            Route::post('/promobanner/status-change', [PromobannerController::class, 'PromoBannerChangeStatus'])->name('promobanner.status');
        });

        // Categories
        Route::prefix('category')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::put('{id}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
            Route::post('/category/status-change', [CategoryController::class, 'categoryChangeStatus'])->name('category.status');
        });

        // Sub Category
        Route::resource('subcategory', SubcategoryController::class);

        // Product
        Route::resource('product', ProductController::class);
        Route::post('/product/status-change', [ProductController::class, 'productChangeStatus'])->name('product.status');
        Route::get('/All-trashed/product', [ProductController::class, 'trashedData'])->name('product.trash');
        Route::get('/restore/{id}/productData', [ProductController::class, 'restoreData'])->name('product.restore');
        Route::delete('/permanant/{id}/productdata', [ProductController::class, 'forceDeleteData'])->name('product.forceDelete');
        Route::get('changeStatus/{id}', [ProductController::class, 'changeStatus'])->name('changeStatus');

        // District route
        Route::get('district', [DistrictController::class, 'index'])->name('district.index');
        Route::post('/district/store/', [DistrictController::class, 'store'])->name('district.store');
        Route::get('district/edit/{id}', [DistrictController::class, 'edit'])->name('district.edit');
        Route::post('district/update', [DistrictController::class, 'update'])->name('district.update');
        Route::delete('district/destroy/{id}', [DistrictController::class, 'destroy'])->name('district.destroy');
        Route::post('/district/status-change', [DistrictController::class, 'districtChangeStatus'])->name('district.status');

        // Upazila Route Here
        Route::get('upazila', [UpazilaController::class, 'index'])->name('upazila.index');
        Route::post('/upazila/store/', [UpazilaController::class, 'storeUpazila'])->name('upazila.store');
        Route::put('/upazilas/{id}', [UpazilaController::class, 'update'])->name('upazilas.update');
        Route::delete('upazila/destroy/{id}', [UpazilaController::class, 'destroyUpazila'])->name('upazila.destroy');
        Route::post('/upazila/status-change', [UpazilaController::class, 'upazilaChangeStatus'])->name('upazila.status');

        // Order routes Here
        Route::get('order', [OrderController::class, 'index'])->name('order.index');
        // Route::post('order-status/{id}', [OrderController::class, 'orderChangeStatus'])->name('orderChangeStatus');
        Route::get('orders-show/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::delete('orders-destroy/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/admin/filter-order', [OrderController::class, 'orderFilter'])->name('filter.orders');
        Route::post('/order/change-status/{id}', [OrderController::class, 'orderChangeStatus'])->name('orderChangeStatus');

        // shipping routes
        Route::get('shipping', [ShippingController::class, 'index'])->name('shipping.index');
        Route::post('shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
        Route::delete('shipping/{id}/destroy', [ShippingController::class, 'destroy'])->name('shipping.destroy');
        Route::put('/shipping/{id}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::get('shipping-status/{id}', [ShippingController::class, 'shippingChangeStatus'])->name('shipping.status');

        // payment method routes here
        Route::get('payment_method', [PaymentMethodController::class, 'index'])->name('payment_method.index');
        Route::get('payment-method/create', [PaymentMethodController::class, 'create'])->name('payment_method.create');
        Route::post('payment-method/create', [PaymentMethodController::class, 'store'])->name('payment_method.store');
        Route::get('payment-method/edit/{id}', [PaymentMethodController::class, 'edit'])->name('payment_method.edit');
        Route::put('payment-method/update/{id}', [PaymentMethodController::class, 'update'])->name('payment_method.update');
        Route::delete('payment-method/delete/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_method.destroy');

        // Post Category
        Route::get('/post-category/', [PostCategoryController::class, 'index'])->name('post_category.index');
        Route::post('/post-category/store', [PostCategoryController::class, 'store'])->name('post_category.store');
        Route::post('/post-category/update', [PostCategoryController::class, 'update'])->name('post_category.update');
        Route::delete('/post-category/delete/{id}', [PostCategoryController::class, 'destroy'])->name('post_category.destroy');
        Route::post('/post-category/status-change/', [PostCategoryController::class, 'statusChange'])->name('post_category.status');
        Route::post('/post-category/status-change', [PostCategoryController::class, 'changeStatus'])->name('post_category.status');

        // Posts
        Route::resource('post', PostController::class);
        Route::post('/post/status-change', [PostController::class, 'postChangeStatus'])->name('post.status');

        // About Page
        Route::prefix('about-page')->group(function () {
            Route::get('/', [AboutPageController::class, 'index'])->name('about_page.page');
            Route::post('/chairman/update/{id}', [AboutPageController::class, 'update'])->name('chairman.update');

            Route::get('/mission/vision', [AboutPageController::class, 'missionVision'])->name('mission_vision.page');

            Route::post('/chairman/mission/update', [AboutPageController::class, 'missionUpdate'])->name('mission.update');
            Route::post('/chairman/vision/update', [AboutPageController::class, 'visionUpdate'])->name('vision.update');
        });

        // Contact form message route
        Route::get('message', [InboxController::class, 'index'])->name('inboxed_message');
        Route::get('message-show/{id}', [InboxController::class, 'show'])->name('message.show');
        Route::delete('message/delete/{id}', [InboxController::class, 'destroy'])->name('message.destroy');

        // Newsletter
        Route::get('Newslatter', [NewslatterController::class, 'index'])->name('newslatter');
        Route::get('Newslatter/destroy/{id}', [NewslatterController::class, 'destroy'])->name('newslatter.destroy');


        // SMS Settings
        Route::get('sms-settings', [SmsSettingController::class, 'edit'])->name('sms-settings.edit');
        Route::put('sms-settings', [SmsSettingController::class, 'update'])->name('sms-settings.update');
    });
