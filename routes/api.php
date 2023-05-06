<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeMarketCategoryController;
use App\Http\Controllers\HomeRentalCategoryController;
use App\Http\Controllers\MarketCategoryController;
use App\Http\Controllers\RentalCategoryController;
use App\Http\Controllers\MarketCartController;
use App\Http\Controllers\EventReportController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\MarketReportController;
use App\Http\Controllers\RentalReportController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MarketReviewController;
use App\Http\Controllers\EventReviewController;
use App\Http\Controllers\EventBookingController;
use App\Http\Controllers\RentalBookingController;
use App\Http\Controllers\PollVoteController;
use App\Http\Controllers\RentalReviewController;
use App\Http\Controllers\PostReviewController;
use App\Http\Controllers\ResourceReviewController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MarketSubCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ClubChatRoomController;
use App\Http\Controllers\UserChatRoomController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RelatedPostController;
use App\Http\Controllers\RoomUserController;
use App\Http\Middleware\CustomAuthMiddleware;
use App\Models\Market;
use Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::fallback(function () {
    return response()->json(['message' => 'Resource not found'], 404);
})->where('fallback', '(.*)');
//////////////////////////////////////////////// PRIVATE ROUTES //////////////////////////////////////////////// 
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->post('logout', [AuthenticatedSessionController::class, 'destroy']);
// categories
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('categories/create', [CategoryController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('categories/{category}', [CategoryController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('categories/{category}', [CategoryController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('categories/{category}', [CategoryController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('feeds/{feed}', [FeedController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('messages/{message}', [MessageController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('marketcategories/create', [MarketCategoryController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('rentalcategories/create', [RentalCategoryController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('locations/create', [LocationController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('years/create', [YearController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('courses/create', [CourseController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('marketcategories/{marketcategory}', [MarketCategoryController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('rentalcategories/{rentalcategory}', [RentalCategoryController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('locations/{location}', [LocationController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('years/{year}', [YearController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('courses/{course}', [CourseController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('marketreviews/{marketreview}', [MarketReviewController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('rentalreviews/{rentalreview}', [RentalReviewController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('pollvotes/{pollvote}', [PollVoteController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('room-users/{userSubscription}', [RoomUserController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('eventreviews/{eventreview}', [EventReviewController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('getmarketreviews/{marketreview}', [MarketReviewController::class, 'count']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('marketcategories/{marketcategory}', [MarketCategoryController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('rentalcategories/{rentalcategory}', [RentalCategoryController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('locations/{location}', [LocationController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('years/{year}', [YearController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('courses/{course}', [CourseController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('marketreviews/{marketreview}', [MarketReviewController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('rentalreviews/{rentalreview}', [RentalReviewController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('pollvotes/{pollvote}', [PollVoteController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('marketcategories/{marketcategory}', [MarketCategoryController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('rentalcategories/{rentalcategory}', [RentalCategoryController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('locations/{location}', [LocationController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('years/{year}', [YearController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('courses/{course}', [CourseController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('marketreviews/{marketreview}', [MarketReviewController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('rentalreviews/{rentalreview}', [RentalReviewController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('pollvotes/{pollvote}', [PollVoteController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('postreviews/{postreview}', [PostReviewController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('resourcereviews/{resourcereview}', [ResourceReviewController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('eventreviews/{eventreview}', [EventReviewController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('marketsubcategories/create', [MarketSubCategoryController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->get('marketsubcategories/{marketsubcategory:name}', [MarketSubCategoryController::class, 'show']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('marketsubcategories/{marketsubcategory}', [MarketSubCategoryController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('marketsubcategories/{marketsubcategory}', [MarketSubCategoryController::class, 'destroy']);
// posts
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('posts', [PostController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('club_posts', [PostController::class, 'club_store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('posts/{post:slug}', [PostController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('users/{user:slug}', [UserController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('posts/{post}', [PostController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('clubs', [ClubController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('clubs/{club:slug}', [ClubController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('clubs/{club}', [ClubController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('clubchats', [ClubChatRoomController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('clubchats/{clubchat}', [ClubChatRoomController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('userchats', [UserChatRoomController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('userchats/{userchat}', [UserChatRoomController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('subscribetoclubchatroom', [RoomUserController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('resources', [ResourceController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('resources/{resource:slug}', [ResourceController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('resources/{resource}', [ResourceController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('markets', [MarketController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('rentals', [RentalController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('polls', [PollController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('events', [EventController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('carts', [MarketCartController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('carts/{cart}', [MarketCartController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('votes', [PollVoteController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('votes/{vote}', [PollVoteController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('reports', [MarketReportController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('rental_reports', [RentalReportController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('eventreports', [EventReportController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('connects', [ConnectionController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('marketreviews', [MarketReviewController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('rentalreviews', [RentalReviewController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('pollvotes', [PollVoteController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('eventreviews', [EventReviewController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('eventbookings', [EventBookingController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('rentalbookings', [RentalBookingController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('markets/{market:slug}', [MarketController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('rentals/{rental:slug}', [RentalController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('polls/{poll:slug}', [PollController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('events/{event:slug}', [EventController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('markets/{market}', [MarketController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('rentals/{rental}', [RentalController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('polls/{poll}', [PollController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('connections/{connection}', [ConnectionController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->put('connections/{connection}', [ConnectionController::class, 'update']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->delete('events/{event}', [EventController::class, 'destroy']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('postreviews', [PostReviewController::class, 'store']);
Route::middleware(['auth:sanctum', 'throttle:1200,1'])->post('resourcereviews', [ResourceReviewController::class, 'store']);
//////////////////////////////////////////////// PUBLIC ROUTES //////////////////////////////////////////////// 
Route::post('register', [RegisteredUserController::class, 'store']);
// Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/connections', [ConnectionController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/categories', [CategoryController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/homemarketcategories', [HomeMarketCategoryController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/homerentalcategories', [HomeRentalCategoryController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/marketcategories', [MarketCategoryController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/rentalcategories', [RentalCategoryController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/locations', [LocationController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/years', [YearController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/courses', [CourseController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/marketreviews', [MarketReviewController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/rentalreviews', [RentalReviewController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/pollvotes', [PollVoteController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/eventreviews', [EventReviewController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/market-reviews/average-rating/{marketId}', [MarketReviewController::class, 'count']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/marketsubcategories', [MarketSubCategoryController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/getmarketsubcategories', [MarketSubCategoryController::class, 'getSub']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/getmarketcategories', [MarketCategoryController::class, 'getSub']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/getrentalcategories', [RentalCategoryController::class, 'getSub']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/getlocations', [LocationController::class, 'getSub']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/getyears', [YearController::class, 'getSub']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/getcourses', [CourseController::class, 'getSub']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/postreviews', [PostReviewController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/resourcereviews', [ResourceReviewController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/home-posts', [HomeController::class, 'index']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/posts/{post:slug}', [PostController::class, 'show']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubs/{club:slug}', [ClubController::class, 'show']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubarticles/{club:slug}', [ClubController::class, 'show_club_articles']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubmarkets/{club:slug}', [ClubController::class, 'show_club_markets']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubevents/{club:slug}', [ClubController::class, 'show_club_events']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubpolls/{club:slug}', [ClubController::class, 'show_club_polls']);
// Route::middleware('throttle:1200,1')->get('clubresources/{club:slug}', [ClubController::class, 'show_club_resources']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubresources/{club:slug}', [ClubController::class, 'show_club_resources']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubusers/{club:slug}', [ClubController::class, 'show_club_users']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/clubchats/{clubchat:slug}', [ClubChatRoomController::class, 'show']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/userchats/{userchat:slug}', [UserChatRoomController::class, 'show']);
Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/resources/{resource:slug}', [ResourceController::class, 'show']);

Route::middleware('throttle:1200,1')->get('markets/{market:slug}', [MarketController::class, 'show']);
Route::middleware('throttle:1200,1')->get('rentals/{rental:slug}', [RentalController::class, 'show']);
Route::middleware('throttle:1200,1')->get('polls/{poll:slug}', [PollController::class, 'show']);
Route::middleware('throttle:1200,1')->get('events/{event:slug}', [EventController::class, 'show']);
Route::middleware('throttle:1200,1')->get('users/{user:slug}', [UserController::class, 'show']);
Route::middleware('throttle:1200,1')->get('posts', [PostController::class, 'index']);
Route::middleware('throttle:1200,1')->get('clubs', [ClubController::class, 'index']);
Route::middleware('throttle:1200,1')->get('clubchats', [ClubChatRoomController::class, 'index']);
Route::middleware('throttle:1200,1')->get('userchats', [UserChatRoomController::class, 'index']);
Route::middleware('throttle:1200,1')->get('resources', [ResourceController::class, 'index']);
Route::middleware('throttle:1200,1')->get('feeds', [FeedController::class, 'index']);
Route::middleware('throttle:1200,1')->get('messages', [MessageController::class, 'index']);

Route::middleware(['throttle:1200,1', CustomAuthMiddleware::class])->get('/markets', [MarketController::class, 'index']);

Route::middleware('throttle:1200,1')->get('rentals', [RentalController::class, 'index']);
Route::middleware('throttle:1200,1')->get('polls', [PollController::class, 'index']);
Route::middleware('throttle:1200,1')->get('events', [EventController::class, 'index']);
Route::post('feeds', [FeedController::class, 'store']);
Route::post('messages', [MessageController::class, 'store']);
Route::middleware('throttle:1200,1')->get('carts', [MarketCartController::class, 'index']);
Route::middleware('throttle:1200,1')->get('votes', [PollVoteController::class, 'index']);
Route::middleware('throttle:1200,1')->get('marketings', [MarketController::class, 'similarProds']);
Route::middleware('throttle:1200,1')->get('home', [MarketController::class, 'home']);
Route::middleware('throttle:1200,1')->get('marketrevs/${marketId}', [MarketController::class, 'countReviews']);
Route::middleware('throttle:1200,1')->get('users', [UserController::class, 'index']);
Route::middleware('throttle:1200,1')->get('searchcomrades', [UserController::class, 'searchcomrade']);
Route::middleware('throttle:1200,1')->get('related-posts/{post:slug}', [RelatedPostController::class, 'index']);
Route::middleware('throttle:1200,1')->get('dashboard-posts', [DashboardPostController::class, 'index']);

Route::middleware('throttle:1200,1')->get('/search', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('markets')->where('product_name', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchrental', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('rentals')->where('rental_name', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchpost', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('posts')->where('title', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchuser', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('users')->where('name', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchclub', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('clubs')->where('name', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchresource', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('resources')->where('title', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchevent', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('events')->where('title', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});

Route::middleware('throttle:1200,1')->get('/searchpoll', function(Request $request) {
    $query = $request->input('q');
    $results = DB::table('polls')->where('title', 'like', "%$query%")->take(9)->get();
    return response()->json($results);
});


Route::middleware('throttle:1200,1')->get('/viewed-markets', function () {
    $viewedMarkets = session('viewed_markets', []);
    $markets = Market::whereIn('id', $viewedMarkets)->get();
    return response()->json($markets);
});