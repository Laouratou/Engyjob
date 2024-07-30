<?php

use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProposController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CallBackController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Company\dashboardController as CompanyDashboardController;
use App\Http\Controllers\Company\FreelancerController;
use App\Http\Controllers\Company\ProjectController as CompanyProjectController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EtapeCleController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FreelancerLevelController;
use App\Http\Controllers\FreelancerMembershipController;
use App\Http\Controllers\Freelancers\DashBoardController;
use App\Http\Controllers\Freelancers\ProjectController as FreelancersProjectController;
use App\Http\Controllers\Freelancers\SettingsController;
use App\Http\Controllers\FreelancerTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDurationController;
use App\Http\Controllers\ProjectFileController;
use App\Http\Controllers\ProjectLanguageController;
use App\Http\Controllers\ProjectLanguageLevelController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserPaymentController;
use App\Http\Controllers\VerifyIdentityController;
use App\Http\Controllers\WalletTransactionController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ConfidentialityController;
use App\Http\Controllers\NoteController;
use App\Http\Middleware\FreelancerMiddleware;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WithdrawalController;



Route::group(['middleware' => ['blocked']], function () {



    Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

    Auth::routes();


    Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
        // Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('dashboard', [AdminDashBoardController::class, 'AdminDashboard'])
            ->name('dashboard');

        Route::get('get_all_projects', [AdminDashBoardController::class, 'admin_get_all_projects'])
            ->name('admin_get_all_projects');

        Route::get('get_all_freelancers', [AdminDashBoardController::class, 'admin_get_all_freelancers'])
            ->name('admin_get_all_freelancers');

        Route::get('get_all_companies', [AdminDashBoardController::class, 'admin_get_all_companies'])
            ->name('admin_get_all_companies');

        Route::get('get_all_memberships', [AdminDashBoardController::class, 'admin_get_all_memberships'])
            ->name('admin_get_all_memberships');

        Route::get('get_all_id_verifications', [AdminDashBoardController::class, 'admin_get_all_id_verifications'])
            ->name('admin_get_all_id_verifications');

        Route::post('change_is_verify_state', [AdminDashBoardController::class, 'change_is_verify_state'])
            ->name('change_is_verify_state');

        Route::post('change_is_rejected_state', [AdminDashBoardController::class, 'change_is_rejected_state'])
            ->name('change_is_rejected_state');

        Route::resources(['categories' => CategoryController::class]);
        Route::resources(['skills' => SkillController::class]);
        Route::resources(['project_languages' => ProjectLanguageController::class]);
        Route::resources(['project_languages_levels' => ProjectLanguageLevelController::class]);
        Route::resources(['freelancer_levels' => FreelancerLevelController::class]);
        Route::resources(['freelancer_types' => FreelancerTypeController::class]);
        Route::resources(['project_durations' => ProjectDurationController::class]);

        //toggleActive
        Route::post('toggleActive', [BaseController::class, 'toggleActive'])->name('toggleActive');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'freelancers'], function () {
        Route::get('dashboard', [DashBoardController::class, 'FreelancersDashboard'])
            ->name('freelancers.dashboard');

        Route::get('dashboard/my_proposals', [FreelancersProjectController::class, 'my_proposals'])
            ->name('freelancers.my_proposals');

        //
        Route::get('p/projects/details/{id}', [FreelancersProjectController::class, 'project_details'])
            ->name('freelancers.projects.details');

        Route::get('p/projects/manage_etape_cles/{id}', [FreelancersProjectController::class, 'manage_etape_cles'])
            ->name('freelancers.projects.manage_etape_cles');

        Route::get('p/projects/manage_tasks/{id}', [FreelancersProjectController::class, 'manage_task'])
            ->name('freelancers.projects.manage_tasks');

        Route::get('p/projects/project_files/{id}', [FreelancersProjectController::class, 'project_files'])
            ->name('freelancers.projects.project_files');

        Route::delete('/project-files/{file}', [FreelancersProjectController::class, 'delete'])
            ->name('project.files.delete');



        Route::get('p/projects/ongoing_projects', [FreelancersProjectController::class, 'ongoing_projects'])
            ->name('freelancers.projects.ongoing_projects');

        Route::get('p/projects/completed_projects', [FreelancersProjectController::class, 'completed_projects'])
            ->name('freelancers.projects.completed_projects');

        Route::get('p/projects/cancelled_projects', [FreelancersProjectController::class, 'cancelled_projects'])
            ->name('freelancers.projects.cancelled_projects');

        Route::get('p/projects/expired_projects', [FreelancersProjectController::class, 'expired_projects'])
            ->name('freelancers.projects.expired_projects');

        Route::get('p/freelancers/membership', [FreelancerMembershipController::class, 'freelancer_membership'])
            ->name('freelancers.membership');

        Route::get('p/reviews', [ReviewController::class, 'get_freelancer_reviews'])
            ->name('freelancers.reviews');

        Route::get('p/company/reviews', [ReviewController::class, 'get_comapny_reviews'])
            ->name('company.reviews');

        Route::post('p/reviews', [ReviewController::class, 'store_freelancer_reviews'])
            ->name('freelancers.reviews');

        Route::get('p/reviews', [DashBoardController::class, 'user_payments'])
            ->name('freelancers.user_payments');
    });




    Route::get('/get-profile-data', [ProfilesController::class, 'getProfileData']);
    Route::get('/get-proposals-by-month', [ProfilesController::class, 'getProposalsByMonth'])->middleware('auth');


    Route::get('/api/propositions-per-month', [ProposalController::class, 'getPropositionsPerMonth']);



    Route::get('/hired-proposals', [ProjectController::class, 'getHiredProjects']);


    Route::get('/hired-proposals', [ProposalController::class, 'getHiredProposalsCount']);


    Route::get('/proposals-received', [ProposalController::class, 'getProposalsReceived']);

    Route::get('/published-projects', [ProjectController::class, 'publishedProjects']);



    Route::get('transactions-per-month', [WalletTransactionController::class, 'transactionsPerMonth']);


    Route::get('/user-proposals-count', [ProjectController::class, 'getUserProposalsCount']);


    Route::get('/favorite-projects', [ProjectController::class, 'getFavoriteProjectsCount']);



    Route::get('/proposed-projects', [ProjectController::class, 'getProposedProjects']);
    Route::get('/hired-projects', [ProjectController::class, 'getHiredProjects']);


    Route::get('/user-projects-with-proposals', [ProjectController::class, 'getUserProjectsWithProposals']);



    Route::group(['middleware' => ['auth'], 'prefix' => 'company'], function () {
        Route::get('p/dashboard', [CompanyDashboardController::class, 'companyDashboard'])
            ->name('company.dashboard');

        Route::get('p/all_projects', [CompanyProjectController::class, 'all_projects'])
            ->name('company.all_projects');

        Route::get('p/projects/details/{id}', [CompanyProjectController::class, 'details'])
            ->name('company.projects.details');

        Route::post('p/projects/hire_freelancer', [CompanyProjectController::class, 'hire_freelancer'])
            ->name('company.projects.hire_freelancer');

        Route::get('p/projects/manage_etape_cles/{id}', [CompanyProjectController::class, 'manage_etape_cles'])
            ->name('company.projects.manage_etape_cles');

        Route::get('p/projects/manage_task/{id}', [CompanyProjectController::class, 'manage_task'])
            ->name('company.projects.manage_tasks');

        Route::get('p/projects/project_files/{id}', [CompanyProjectController::class, 'project_files'])
            ->name('company.projects.project_files');
        Route::delete('/projects/files/{file_id}', [CompanyProjectController::class, 'delete_project_file'])
            ->name('projects.files.delete');

        Route::get('p/projects/pending_projects', [CompanyProjectController::class, 'pending_projects'])
            ->name('company.projects.pending_projects');

        Route::get('p/projects/ongoing_projects', [CompanyProjectController::class, 'ongoing_projects'])
            ->name('company.projects.ongoing_projects');

        Route::get('p/projects/completed_projects', [CompanyProjectController::class, 'completed_projects'])
            ->name('company.projects.completed_projects');

        Route::get('p/projects/cancelled_projects', [CompanyProjectController::class, 'cancelled_projects'])
            ->name('company.projects.cancelled_projects');

        Route::get('p/projects/expired_projects', [CompanyProjectController::class, 'expired_projects'])
            ->name('company.projects.expired_projects');

        Route::get('p/company_payments', [CompanyDashboardController::class, 'user_payments'])
            ->name('company.user_payments');
    });

    Route::middleware(['auth'])->group(function () {

        Route::resource('services', ServiceController::class);


        Route::post('/membership/select', [MembershipController::class, 'selectPlan'])->name('membership.select');
        Route::post('/membership/use-service', [MembershipController::class, 'useService'])->name('membership.useService');

        Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');




        Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
        Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
        Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');

        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/projects/{project}/favorite/toggle', [FavoriteController::class, 'toggle'])->name('projects.favorite.toggle');
        Route::middleware([FreelancerMiddleware::class])->group(function () {
            Route::resources([
                'projects' => ProjectController::class,
            ]);
        });
        Route::get('/confidentiality', [ConfidentialityController::class, 'show'])->name('confidentiality.show');
        Route::resources(['proposals' => ProposalController::class]);
        Route::resources(['etape_cles' => EtapeCleController::class]);
        Route::resources(['tasks' => TaskController::class]);
        Route::resources(['project_files' => ProjectFileController::class]);
        Route::resources(['memberships' => MembershipController::class]);


        Route::resource('plans', PlanController::class);


        Route::post('/update-user-memberships', [MembershipController::class, 'updateUserMemberships'])->name('update.user.memberships');

        Route::resources(['wallet_transactions' => WalletTransactionController::class]);
        Route::resources(['user_payments' => UserPaymentController::class]);

        Route::get('dashboard/profile/settings', [SettingsController::class, 'FreelancersProfileSettings'])
            ->name('freelancers.profile.settings');

        Route::post('change_stape_cle_status', [EtapeCleController::class, 'change_stape_cle_status'])
            ->name('change_stape_cle_status');

        Route::post('change_task_status', [TaskController::class, 'change_task_status'])
            ->name('change_task_status');

        Route::post('dashboard/profile/settings', [SettingsController::class, 'FreelancersProfileSettingsUpdate'])
            ->name('freelancers.profile.settings.post');


        Route::delete('delete-education', [EducationController::class, 'delete_education'])->name('education.delete');
        Route::delete('delete-experience', [ExperienceController::class, 'delete_experience'])->name('experience.delete');

        Route::get('p/change_password', [ChangePasswordController::class, 'change_password'])
            ->name('change_password');

        Route::post('p/change_password', [ChangePasswordController::class, 'change_password_post'])
            ->name('change_password_post');

        Route::get('p/verify_identity', [VerifyIdentityController::class, 'verify_identity'])
            ->name('verify_identity');

        Route::post('p/verify_identity_post', [VerifyIdentityController::class, 'verify_identity_post'])
            ->name('verify_identity_post');

        Route::post('p/cancel_membership', [FreelancerMembershipController::class, 'cancel_membership'])
            ->name('cancel_membership');

        Route::post('p/change_project_status', [ProjectController::class, 'change_project_status'])

            ->name('change_project_status');


        Route::get('success_payment', [BaseController::class, 'success_payment'])
            ->name('success_payment');

        Route::get('error_payment', [BaseController::class, 'error_payment'])
            ->name('error_payment');

            Route::get('success_retrait', [BaseController::class, 'success_retrait'])
            ->name('success_retrait');

        Route::get('error_retrait', [BaseController::class, 'error_retrait'])
            ->name('error_retrait');
   

    });




    Route::resource('configs', ConfigController::class);



    Route::get('projects/details/{id}', [ProjectController::class, 'details'])
        ->name('projects/details');

    Route::get('p/projects/liste/{category_id?}', [CompanyProjectController::class, 'projects_liste'])
        ->name('projects.liste');

    Route::get('p/freelancers/liste', [FreelancerController::class, 'freelancers_list'])
        ->name('freelancers.liste');

    Route::get('p/freelancers/profile/{id}', [FreelancerController::class, 'freelancers_details'])
        ->name('freelancers.profile');

    Route::get('your-profile-blocked', [BaseController::class, 'blocked'])
        ->name('blocked');
});

Route::get('/Faq', [ProposController::class, 'index'])->name('Faq');

// Route pour afficher le formulaire de contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Route pour traiter la soumission du formulaire de contact
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
// routes/web.php



Route::post('/search', [SearchController::class, 'search'])->name('search');


Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');




Route::post('/ligdicash/withdrawal', [PaymentController::class, 'createWithdrawal'])->name('ligdicash.withdrawal');
Route::get('/ligdicash/transaction-status/{token}', [PaymentController::class, 'checkTransactionStatus']);


Route::post('callback', [CallBackController::class, 'callback']);
Route::get('/create-invoice', [PaymentController::class, 'createInvoice'])->name('createInvoice');
