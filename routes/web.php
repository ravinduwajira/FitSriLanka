<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ProfessionalInfoController;
use App\Http\Controllers\FitnessCenterController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\fastingcontroller;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HealthStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfessionalTask;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tasks', TaskController::class);
    Route::resource('ProfessionalTask', ProfessionalTask::class);
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/search', [ChatController::class, 'search'])->name('chat.search');

    Route::get('/community', [PostController::class, 'index'])->name('community.index');
    Route::post('/community/posts', [PostController::class, 'store'])->name('community.posts.store');
    Route::post('/community/posts/{post}/like', [PostController::class, 'like'])->name('community.posts.like');
    Route::post('/community/posts/{post}/dislike', [PostController::class, 'dislike'])->name('community.posts.dislike');
    
    Route::post('/community/posts/{post}/comments', [CommentController::class, 'store'])->name('community.comments.store');
    Route::delete('/community/posts/{post}', [PostController::class, 'destroy'])->name('community.posts.destroy');

    // User Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

    

    // Admin Revenues
   
    

});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/Admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('Admin.dashboard');
    Route::get('/Admin/logout', [AdminController::class, 'AdminLogout'])->name('Admin.logout');
    Route::get('/Admin/profile', [AdminController::class, 'AdminProfile'])->name('Admin.profile');
    Route::post('/Admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('Admin.profile.store');

    Route::get('/Admin/User_Manage', [AdminController::class, 'User_Manage'])->name('Admin.User_Manage');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.Delete');
    
    Route::get('/Admin/Professional_Manage', [AdminController::class, 'Professional_Manage'])->name('Admin.Professional_Manage');
    Route::delete('/professionals/{id}', [AdminController::class, 'deleteProfessional'])->name('Professional.delete');

    Route::get('/Admin/FitnessCenter_Manage', [AdminController::class, 'manageFitnessCenters'])->name('Admin.manageFitnessCenters');
    Route::delete('/Admin/fitnesscenters/delete/{id}', [AdminController::class, 'deleteFcenter'])->name('Admin.fitnesscenter.delete');

    Route::get('/Admin/revenue', [RevenueController::class, 'adminRevenue'])->name('revenue');

    Route::get('/Admin/chat', [ChatController::class, 'adminchat'])->name('Admin.chat');

    Route::get('/Admin/community', [PostController::class, 'adminpost'])->name('Admin.community');
Route::delete('/Admin/community/posts/{post}', [PostController::class, 'admdestroy'])->name('Admin.community.posts.destroy');
  
});

Route::middleware(['auth', 'role:Professional'])->group(function () {
    Route::get('/Professional/dashboard', [ProfessionalController::class, 'ProfessionalDashboard'])->name('Professional.dashboard');
    Route::get('Professional/logout', [ProfessionalController::class, 'ProfessionalLogout'])->name('Professional.logout');
    Route::get('Professional/info', [ProfessionalInfoController::class, 'ProfessionalInfo'])->name('Professional.info');
    Route::post('Professional/info/store', [ProfessionalInfoController::class, 'ProfessionalInfoStore'])->name('Professional.info.store');
    Route::post('Professional/info/update', [ProfessionalInfoController::class, 'update'])->name('Professional.info.update');
    Route::get('/Professional/profile', [ProfessionalController::class, 'ProfessionalProfile'])->name('Professional.profile');
    Route::post('/Professional/profile/store', [ProfessionalController::class, 'ProfessionalProfileStore'])->name('Professional.profile.store');
   
    Route::get('/Professional/fitnesscenters', [FitnessCenterController::class, 'index'])->name('Professional.fitnesscenter.index');  // Show the form and list
    Route::post('/Professional/fitnesscenters/store', [FitnessCenterController::class, 'store'])->name('Professional.fitnesscenter.store');  // Add or update fitness center
    Route::get('/Professional/fitnesscenters/delete/{id}', [FitnessCenterController::class, 'destroy'])->name('Professional.fitnesscenter.delete');  // Delete fitness center
    Route::put('/Professional/fitnesscenters/update/{id}', [FitnessCenterController::class, 'update'])->name('Professional.fitnesscenter.update');

    Route::get('/Professional/managedietplans', [ProfessionalController::class, 'ManageDietPlan'])->name('Professional.managedietplans');
    
Route::get('/Professional/mealplan/create', [MealPlanController::class, 'create'])->name('Professional.mealplan.create'); // Form to create a meal plan
Route::post('/Professional/mealplan/store', [MealPlanController::class, 'store'])->name('Professional.mealplan.store'); // Store a new meal plan
Route::get('/Professional/mealplan/edit/{id}', [MealPlanController::class, 'edit'])->name('Professional.mealplan.edit'); // Edit an existing meal plan
Route::put('/Professional/mealplan/update/{id}', [MealPlanController::class, 'update'])->name('Professional.mealplan.update'); // Update meal plan
Route::delete('/Professional/mealplan/delete/{id}', [MealPlanController::class, 'destroy'])->name('Professional.mealplan.delete'); // Delete a meal plan

Route::get('/Professional/manageworkout', [ProfessionalController::class, 'ManageWorkoutPlan'])->name('Professional.manageworkout');
Route::post('/Professional/workoutplan/store', [WorkoutPlanController::class, 'storeWorkoutPlan'])->name('Professional.workoutplan.store');
Route::get('/Professional/workoutplan/fetch', [WorkoutPlanController::class, 'getWorkoutPlan'])->name('Professional.workoutplan.fetch');
Route::put('/Professional/workoutplan/update', [WorkoutPlanController::class, 'workoutupdate'])->name('Professional.workoutplan.update');

Route::get('/Professional/ManageClients', [ProfessionalController::class, 'ManageClients'])->name('Professional.manageclients');

Route::get('/Professional/chat', [ChatController::class, 'professionalchat'])->name('Professional.chat');

// Professional Revenues
Route::get('/Professional/revenue', [RevenueController::class, 'professionalRevenue'])->name('Professional.revenue');

Route::get('/Professional/community', [PostController::class, 'professionalpost'])->name('Professional.community');
Route::delete('/Professional/community/posts/{post}', [PostController::class, 'prodestroy'])->name('Professional.community.posts.destroy');
Route::get('/Professional/leaderboard', [LeaderboardController::class, 'userLeaderboard'])->name('Professional.leaderboard');
Route::post('/feedback/user', [FeedbackController::class, 'storeUserFeedback'])->name('feedback.user.store');

});

Route::get('/Admin/login', [AdminController::class, 'AdminLogin'])->name('Admin.login');

Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::get('/logout', [UserController::class, 'UserLogout'])->name('logout');
    Route::get('/userinfo', [UserInfoController::class, 'UserInfo'])->name('userinfo');
    Route::post('/userinfo/store', [UserInfoController::class, 'UserInfoStore'])->name('userinfo.store');
    Route::get('/userprofile', [UserController::class, 'UserProfile'])->name('userprofile');
    Route::post('/userprofile/store', [UserController::class, 'UserProfileStore'])->name('userprofile.store');
    Route::get('/healthstatus', [UserController::class, 'HealthStatus'])->name('healthstatus');
    Route::get('/workout', [WorkoutPlanController::class, 'viewClientWorkoutPlan'])->name('workout');
    
    Route::get('/dietplan', [UserController::class, 'DietPlan'])->name('dietplan');
    Route::get('/fastingtracker', [UserController::class, 'FastingTracker'])->name('fastingTracker');
    Route::get('/professionallist', [UserController::class, 'ProfessionalList'])->name('professionallist');
    Route::post('/toggle-enrollment', [UserController::class, 'toggleEnrollment'])->name('toggleEnrollment');
    Route::get('/fitnesscenterenroll', [UserController::class, 'FitnessCenterEnroll'])->name('fitnesscenterenroll');
    Route::post('/toggleFitnessCenterEnrollment', [UserController::class, 'toggleFitnessCenterEnrollment'])->name('toggleFitnessCenterEnrollment');

    Route::post('/store-workout-history', [WorkoutPlanController::class, 'storeWorkoutHistory'])->name('store.workout.history');

    Route::post('/start-fasting/{plan}', [fastingcontroller::class, 'startFasting'])->name('fasting.start');
    Route::post('/end-fasting', [fastingcontroller::class, 'endFasting'])->name('fasting.end');
    Route::get('/active-fast', [fastingcontroller::class, 'getActiveFast'])->name('get.active.fast');
    
    Route::get('/calendar', [EventsController::class, 'index'])->name('calendar');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    Route::get('/health-status', [HealthStatusController::class, 'index'])->name('health.status');
    Route::post('/health-status', [HealthStatusController::class, 'store'])->name('health.status.store');

    Route::get('/reports', [ReportController::class, 'showHealthReports'])->name('health.reports');

    Route::get('/leaderboard', [LeaderboardController::class, 'professionalLeaderboard'])->name('leaderboard');
    Route::post('/feedback/professional', [FeedbackController::class, 'storeProfessionalFeedback'])->name('feedback.professional.store');


    


});
