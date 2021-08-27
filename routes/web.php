<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/lock-screen', 'LocScreenController@LockScreen')->name('LokcScreen');

Route::get('/', 'FrontendController@index')->name('frontpage');

Route::get('/home', 'FrontendController@index')->name('home');

Route::get('/user-chart', 'ChartController@UserChart')->name('UserChart');

Route::get('/search', 'FrontendController@search')->name('search');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', 'HomeController@Dashboard')->name('Dashboard');

    //======================== USER ROUTE ARE HERE ========================

    Route::get('/view-users', 'UserController@ViewUsers')->name('ViewUsers');
    Route::get('/post-utype/{id}', 'UserController@MakeAdmin')->name('MakeAdmin');
    Route::get('/add-category', 'CategoryController@AddCategory')->name('AddCategory');
    Route::post('/post-category', 'CategoryController@PostCategory')->name('PostCategory');
    Route::get('/view-category', 'CategoryController@ViewCategory')->name('ViewCategory');
    Route::get('/delete-category/{cat_id}', 'CategoryController@DeleteCategory')->name('DeleteCategory');
    Route::get('/edit-category/{cat_id}', 'CategoryController@EditCategory')->name('EditCategory');
    Route::post('/update-category', 'CategoryController@UpdateCategory')->name('UpdateCategory');
    Route::get('/trash-category', 'CategoryController@TrashCategory')->name('TrashCategory');
    Route::get('/restore-category/{cat_id}', 'CategoryController@RestoreCategory')->name('RestoreCategory');
    Route::get('/parmanent-category/{cat_id}', 'CategoryController@ParmanentCategory')->name('ParmanentCategory');

    //SubCategory......
    Route::get('/add-subcategory', 'SubCategoryController@AddSubCategory')->name('AddSubCategory');
    Route::post('/post-subcategory', 'SubCategoryController@PostSubCategory')->name('PostSubCategory');
    Route::get('/view-subcategory', 'SubCategoryController@ViewSubCategory')->name('ViewSubCategory');

    //Product......
    Route::get('/add-product', 'ProductController@AddProduct')->name('AddProduct');
    Route::post('/post-product', 'ProductController@PostProduct')->name('PostProduct');
    Route::get('/view-product-section', 'ProductController@ViewProductSection')->name('ViewProductSection');
    Route::post('/post-product-section', 'ProductController@PostProductSection')->name('PostProductSection');
    Route::get('/view-product', 'ProductController@ViewProduct')->name('ViewProduct');
    Route::get('/delete-product/{pro_id}', 'ProductController@DeleteProduct')->name('DeleteProduct');
    Route::get('/trash-product', 'ProductController@TrashProduct')->name('TrashProduct');
    Route::get('/parmanent-product/{pro_id}', 'ProductController@ParmanentProduct')->name('ParmanentProduct');
    Route::get('/edit-product/{edit_id}', 'ProductController@EditProduct')->name('EditProduct');
    Route::post('/update-product', 'ProductController@UpdateProduct')->name('UpdateProduct');

    //===================== VIEW SHPPING ORDERS ROUTE ARE HRE =====================
    Route::get('/view-shipping', 'ShippingController@ViewShpping')->name('ViewShpping');
    Route::get('/delete-shipping/{d_id}', 'ShippingController@DeleteShpping')->name('DeleteShpping');
});



Route::get('/product-rating', 'HomeController@ProductRating')->name('ProductRating');
Route::post('/post-product-rating', 'FrontendController@PostProductRating')->name('PostProductRating');
Route::post('/search-product', 'FrontendController@SearchProduct')->name('SearchProduct');

//Card Route
Route::get('/cart', 'CartController@Cart')->name('Cart');
Route::get('/cart/{slug}', 'CartController@Cart')->name('CouponeRoute');

Route::get('/cart/add/basket/{slug}', 'CartController@SingelCart')->name('SingelCart');
Route::get('/singel/cart/delete/{slug}', 'CartController@SingelCartDelete')->name('SingelCartDelete');
Route::post('/singel/product/cart', 'CartController@SingelProductCart')->name('SingelProductCart');
Route::post('/cart/update)', 'CartController@CartUpdate')->name('CartUpdate');

//Checkout
Route::get('/checkout', 'CheckoutController@Checkout')->name('Checkout');
Route::post('/checkout', 'PaymentController@FinalCheckout')->name('FinalCheckout');
Route::get('/status', 'PaymentController@getPaymentStatus')->name('status');

//Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');

//Route::get('payment/success', 'PaymentController@success')->name('payment.success');




//Get State From Ajax
Route::get('/api/get-state-list/{id}', 'CheckoutController@getState')->name('getState');
Route::get('/api/get-city-list/{id}', 'CheckoutController@getCity')->name('getCity');


Route::get('/singel-product/{slug}', 'FrontendController@SingelProduct')->name('SingelProduct');

Route::get('/shop', 'FrontendController@shop')->name('shop');

Route::get('/api/get-category-list/{cat_id}', 'ProductController@GetSubCategory')->name('GetSubCategory');


//Blog ..........
Route::get('/add-blog', 'BlogController@Blog')->name('Blog');
Route::post('/post-blog', 'BlogController@PostBlog')->name('PostBlog');
Route::get('/view-blog', 'BlogController@ViewBlog')->name('ViewBlog');
Route::get('/delete-blog/{slug}', 'BlogController@DeleteBlog')->name('DeleteBlog');
Route::get('/edit-blog/{edit_id}', 'BlogController@EditBlog')->name('EditBlog');
Route::post('/update-blog', 'BlogController@UpdateBlog')->name('UpdateBlog');
Route::get('/blog-page', 'FrontendController@blog')->name('blog');
Route::get('/blog-details/{id}', 'FrontendController@BlogDetails')->name('BlogDetails');
Route::post('/comment-post', 'HomeController@CommentPost')->name('CommentPost');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//===================== LOGIN WITH SOCALITH =======================
Route::get('login/github', 'SocialController@redirectToProvider')->name('GitHub');
Route::get('login/github/callback', 'SocialController@handleProviderCallback')->name('GitHubBack');

//================= Wish ListController ==============================
Route::get('/wishlist', 'wishListController@WishList')->name('WishList');
Route::get('/add-wishList/{slug}', 'wishListController@AddWishlist')->name('AddWishlist');
Route::get('/delete-wishList/{slug}', 'wishListController@DeleteWishlist')->name('DeleteWishlist');

//===============   CONTACT ROUTE ARE HERE ===================================

Route::get('/contact', 'ContactController@Contact')->name('Contact');
Route::post('/post-contact', 'ContactController@PostContact')->name('PostContact');

// ================ SUBSCRIVER NEWSLETTER =====================================
Route::post('/news-letter', 'NewsletterController@Newsletter')->name('Newsletter');
//Route::post('/add_news-letter', 'NewsletterController@PostNewsletter')->name('Newsletter');

// ================ SUBSCRIVER NEWSLETTER =====================================
Route::get('/add-testmonial', 'TestmonialController@AddTestMonial')->name('AddTestMonial');
Route::post('/post-testmonial', 'TestmonialController@PostTestMonial')->name('PostTestMonial');
