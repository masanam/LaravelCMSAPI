<?php

use Illuminate\Http\Request;

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

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });


    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'API\AuthAPIController@logout');

        Route::resource('roles', 'API\RoleAPIController');

        Route::resource('users', 'API\UserAPIController');

        Route::resource('permissions', 'API\PermissionAPIController');

        Route::resource('headers', 'API\HeaderAPIController');

        Route::resource('categories', 'API\CategoryAPIController');

        Route::resource('types', 'API\TypeAPIController');

        Route::resource('statuses', 'API\StatusAPIController');

        Route::resource('groups', 'API\GroupAPIController');

        Route::resource('managements', 'API\ManagementAPIController');

        Route::resource('contents', 'API\ContentAPIController');

        Route::resource('documents', 'API\DocumentAPIController');

        Route::resource('brands', 'API\BrandAPIController');

        Route::resource('careers', 'API\CareerAPIController');

        Route::resource('achievements', 'API\AchievementAPIController');

        Route::resource('certifications', 'API\CertificationAPIController');

        Route::resource('testimonies', 'API\TestimonyAPIController');

        Route::resource('announcements', 'API\AnnouncementAPIController');

        Route::resource('releases', 'API\ReleaseAPIController');
        
        Route::resource('menus', 'API\MenuAPIController');

        Route::resource('directors', 'API\DirectorAPIController');

        Route::resource('jenis', 'API\JenisAPIController');

        Route::resource('dividens', 'API\DividenAPIController');

        Route::resource('dividens', 'API\DividenAPIController');

        Route::resource('contacts', 'API\ContactAPIController');

        Route::resource('products', 'API\ProductAPIController');

        Route::resource('registrants', 'API\RegistrantAPIController');

        Route::resource('sections', 'API\SectionAPIController');

        Route::resource('sliders', 'API\SliderAPIController');

        Route::resource('advisors', 'API\AdvisorAPIController');

        Route::resource('milestones', 'API\MilestoneAPIController');

        Route::resource('varians', 'API\VarianAPIController');

        Route::resource('investors', 'API\InvestorAPIController');

        Route::resource('shares', 'API\ShareAPIController');

        Route::resource('parts', 'API\PartAPIController');

        Route::resource('ownerships', 'API\OwnershipAPIController');

        Route::resource('positions', 'API\PositionAPIController');

        Route::resource('compositions', 'API\CompositionAPIController');

        Route::resource('distributions', 'API\DistributionAPIController');

    });

    Route::group(['prefix' => 'id', 'as' => 'id.'], function () {

    /* Public API */
        Route::get('/getAllMenu', 'API\PublicAPIController@getAllMenu');

        Route::get('/getMenu', 'API\PublicAPIController@getMenu');

        Route::get('/getHeader', 'API\PublicAPIController@getHeader');

        Route::get('/getCategory', 'API\PublicAPIController@getCategory');

        Route::get('/getStatus', 'API\PublicAPIController@getStatus');

        Route::get('/getManagement', 'API\PublicAPIController@getManagement');

        Route::get('/getJenis', 'API\PublicAPIController@getJenis');

        Route::get('/getSection', 'API\PublicAPIController@getSection');

        Route::get('/getMilestone', 'API\PublicAPIController@getMilestone');

        Route::get('/getMenuDetail/{seotitle}', 'API\PublicAPIController@getMenuDetail');


    /*get home*/
    Route::get('/getSlider', 'API\PublicAPIController@getSlider');

    Route::get('/getGroup', 'API\PublicAPIController@getGroup');

    Route::get('/getTypes', 'API\PublicAPIController@getTypes');

    Route::get('/getAdvisor', 'API\PublicAPIController@getAdvisor');

    /*about us*/
    Route::get('/getAboutKino', 'API\PublicAPIController@getAboutKino');

    Route::get('/getOurValue', 'API\PublicAPIController@getOurValue');

    /*career*/
    Route::get('/getLatestCareer', 'API\PublicAPIController@getLatestCareer');

    Route::get('/getCareer', 'API\PublicAPIController@getCareer');

    Route::get('/getCareerDetail/{seotitle}', 'API\PublicAPIController@getCareerDetail');

    Route::get('/getCareerbyGroup/{id}', 'API\PublicAPIController@getCareerbyGroup');


    /*Content*/
    Route::get('/getPressRelease', 'API\PublicAPIController@getPressRelease');

    Route::get('/getPressRelease/{seotitle}', 'API\PublicAPIController@getPressReleaseDetail');

    Route::get('/getMediaCoverage', 'API\PublicAPIController@getMediaCoverage');

    Route::get('/getMediaCoverage/{seotitle}', 'API\PublicAPIController@getMediaCoverageDetail');

    Route::get('/getWorkatKino', 'API\PublicAPIController@getWorkatKino');

    Route::get('/getDevelopmentProgram', 'API\PublicAPIController@getDevelopmentProgram');



    /*news&event*/
    Route::get('/getNews', 'API\PublicAPIController@getNews');

    Route::get('/getNewsDetail/{seotitle}', 'API\PublicAPIController@getNewsDetail');

    Route::get('/getEvent', 'API\PublicAPIController@getEvent');

    Route::get('/getEventDetail/{seotitle}', 'API\PublicAPIController@getEventDetail');

    Route::get('/getCSR', 'API\PublicAPIController@getCSR');

    Route::get('/getCSRDetail/{seotitle}', 'API\PublicAPIController@getCSRDetail');

    /*Achievement*/

    Route::get('/getGroupDetail/{seotitle}', 'API\PublicAPIController@getGroupDetail');

    Route::get('/getPrologCorporate', 'API\PublicAPIController@getPrologCorporate');

    Route::get('/getAchievementCorporate', 'API\PublicAPIController@getAchievementCorporate');

    Route::get('/getPrologBrand', 'API\PublicAPIController@getPrologBrand');

    Route::get('/getAchievementBrand', 'API\PublicAPIController@getAchievementBrand');

    Route::get('/getAchievementDetail/{seotitle}', 'API\PublicAPIController@getAchievementDetail');

    Route::get('/getCertification', 'API\PublicAPIController@getCertification');


    /*management*/
    Route::get('/getDirector', 'API\PublicAPIController@getDirector');

    Route::get('/getDirectorDetail/{seotitle}', 'API\PublicAPIController@getDirectorDetail');

    Route::get('/getCommissioner', 'API\PublicAPIController@getCommissioner');

    Route::get('/getCommissionerDetail/{seotitle}', 'API\PublicAPIController@getCommissionerDetail');

    Route::get('/getCommittee', 'API\PublicAPIController@getCommittee');

    Route::get('/getInnovations', 'API\PublicAPIController@getInnovations');

    Route::get('/getOrganizationData', 'API\PublicAPIController@getOrganizationData');

    Route::get('/getAllDirector', 'API\PublicAPIController@getAllDirector');



    /*brand*/
    Route::get('/getBrandbyType/{type}', 'API\PublicAPIController@getBrandbyType');

    Route::get('/getBrandDetail/{seotitle}', 'API\PublicAPIController@getBrandDetail');

    Route::get('/getTypewithChild', 'API\PublicAPIController@getTypewithChild');

    Route::get('/getBrandwithChild', 'API\PublicAPIController@getBrandwithChild');


    /*testimony*/
    Route::get('/getTestimony', 'API\PublicAPIController@getTestimony');

    Route::get('/getTestimonyDetail/{seotitle}', 'API\PublicAPIController@getTestimonyDetail');


    /*Document*/
    Route::get('/getDocumentCatalog', 'API\PublicAPIController@getDocumentCatalog');

    Route::get('/getDocumentArticles', 'API\PublicAPIController@getDocumentArticles');

    Route::get('/getShareHoldingStructure', 'API\PublicAPIController@getShareHoldingStructure');

    Route::get('/getOrganizationStructure', 'API\PublicAPIController@getOrganizationStructure');

    Route::get('/getKoperasiStructure', 'API\PublicAPIController@getKoperasiStructure');

    Route::get('/getProductCatalog', 'API\PublicAPIController@getProductCatalog');


    Route::get('/getDocumentShareholder', 'API\PublicAPIController@getDocumentShareholder');

    Route::get('/getDocumentFinancial', 'API\PublicAPIController@getDocumentFinancial');

    Route::get('/getDocumentAnnualReport', 'API\PublicAPIController@getDocumentAnnualReport');

    Route::get('/getDocumentProspectus', 'API\PublicAPIController@getDocumentProspectus');

    Route::get('/getDocumentCompanyPresentation', 'API\PublicAPIController@getDocumentCompanyPresentation');

    Route::get('/getDocumentOthers', 'API\PublicAPIController@getDocumentOthers');

    Route::get('/getDocumentCharter', 'API\PublicAPIController@getDocumentCharter');


    Route::get('/getDocumentShareInfo', 'API\PublicAPIController@getDocumentShareInfo');

    Route::get('/getDocumentRiskManagement', 'API\PublicAPIController@getDocumentRiskManagement');


    Route::get('/getDividen', 'API\PublicAPIController@getDividen');

    Route::get('/getSharebyOwnership', 'API\PublicAPIController@getSharebyOwnership');

    Route::get('/getSharebyComposition', 'API\PublicAPIController@getSharebyComposition');

    Route::get('/getSharebyPosition', 'API\PublicAPIController@getSharebyPosition');


    Route::get('/getShareInfo', 'API\PublicAPIController@getShareInfo');

    Route::get('/getDocumentPressRelease', 'API\PublicAPIController@getDocumentPressRelease');

    Route::get('/getLatestArticle', 'API\PublicAPIController@getLatestArticle');

    Route::get('/getTermCondition', 'API\PublicAPIController@getTermCondition');

    Route::get('/getPrivacy', 'API\PublicAPIController@getPrivacy');

    Route::get('/getUniqueWorkingEnvironment', 'API\PublicAPIController@getUniqueWorkingEnvironment');

    Route::get('/getDistributionLocal', 'API\PublicAPIController@getDistributionLocal');

    Route::get('/getDistributionInternational', 'API\PublicAPIController@getDistributionInternational');

    Route::get('/search','API\PublicAPIController@search');

});

/*ENGLISH */
Route::group(['prefix' => 'en', 'as' => 'en.'], function () {

    /* Public API */
        Route::get('/getAllMenu', 'API\PublicEnAPIController@getAllMenu');

        Route::get('/getMenu', 'API\PublicEnAPIController@getMenu');

        Route::get('/getHeader', 'API\PublicEnAPIController@getHeader');

        Route::get('/getCategory', 'API\PublicEnAPIController@getCategory');

        Route::get('/getStatus', 'API\PublicEnAPIController@getStatus');

        Route::get('/getManagement', 'API\PublicEnAPIController@getManagement');

        Route::get('/getJenis', 'API\PublicEnAPIController@getJenis');

        Route::get('/getSection', 'API\PublicEnAPIController@getSection');

        Route::get('/getMilestone', 'API\PublicEnAPIController@getMilestone');

        Route::get('/getMenuDetail/{seotitle}', 'API\PublicEnAPIController@getMenuDetail');


    /*get home*/
    Route::get('/getSlider', 'API\PublicEnAPIController@getSlider');

    Route::get('/getGroup', 'API\PublicEnAPIController@getGroup');

    Route::get('/getTypes', 'API\PublicEnAPIController@getTypes');

    Route::get('/getAdvisor', 'API\PublicEnAPIController@getAdvisor');

    /*about us*/
    Route::get('/getAboutKino', 'API\PublicEnAPIController@getAboutKino');

    Route::get('/getOurValue', 'API\PublicEnAPIController@getOurValue');

    /*career*/
    Route::get('/getLatestCareer', 'API\PublicEnAPIController@getLatestCareer');

    Route::get('/getCareer', 'API\PublicEnAPIController@getCareer');

    Route::get('/getCareerDetail/{seotitle}', 'API\PublicEnAPIController@getCareerDetail');

    Route::get('/getCareerbyGroup/{id}', 'API\PublicEnAPIController@getCareerbyGroup');


    /*Content*/
    Route::get('/getPressRelease', 'API\PublicEnAPIController@getPressRelease');

    Route::get('/getPressRelease/{seotitle}', 'API\PublicEnAPIController@getPressReleaseDetail');

    Route::get('/getMediaCoverage', 'API\PublicEnAPIController@getMediaCoverage');

    Route::get('/getMediaCoverage/{seotitle}', 'API\PublicEnAPIController@getMediaCoverageDetail');

    Route::get('/getWorkatKino', 'API\PublicEnAPIController@getWorkatKino');

    Route::get('/getDevelopmentProgram', 'API\PublicEnAPIController@getDevelopmentProgram');



    /*news&event*/
    Route::get('/getNews', 'API\PublicEnAPIController@getNews');

    Route::get('/getNewsDetail/{seotitle}', 'API\PublicEnAPIController@getNewsDetail');

    Route::get('/getEvent', 'API\PublicEnAPIController@getEvent');

    Route::get('/getEventDetail/{seotitle}', 'API\PublicEnAPIController@getEventDetail');

    Route::get('/getCSR', 'API\PublicEnAPIController@getCSR');

    Route::get('/getCSRDetail/{seotitle}', 'API\PublicEnAPIController@getCSRDetail');

    /*Achievement*/

    Route::get('/getGroupDetail/{seotitle}', 'API\PublicEnAPIController@getGroupDetail');

    Route::get('/getPrologCorporate', 'API\PublicEnAPIController@getPrologCorporate');

    Route::get('/getAchievementCorporate', 'API\PublicEnAPIController@getAchievementCorporate');

    Route::get('/getPrologBrand', 'API\PublicEnAPIController@getPrologBrand');

    Route::get('/getAchievementBrand', 'API\PublicEnAPIController@getAchievementBrand');

    Route::get('/getAchievementDetail/{seotitle}', 'API\PublicEnAPIController@getAchievementDetail');

    Route::get('/getCertification', 'API\PublicEnAPIController@getCertification');


    /*management*/
    Route::get('/getDirector', 'API\PublicEnAPIController@getDirector');

    Route::get('/getDirectorDetail/{seotitle}', 'API\PublicEnAPIController@getDirectorDetail');

    Route::get('/getCommissioner', 'API\PublicEnAPIController@getCommissioner');

    Route::get('/getCommissionerDetail/{seotitle}', 'API\PublicEnAPIController@getCommissionerDetail');

    Route::get('/getCommittee', 'API\PublicEnAPIController@getCommittee');

    Route::get('/getInnovations', 'API\PublicEnAPIController@getInnovations');

    Route::get('/getOrganizationData', 'API\PublicEnAPIController@getOrganizationData');

    Route::get('/getAllDirector', 'API\PublicEnAPIController@getAllDirector');



    /*brand*/
    Route::get('/getBrandbyType/{type}', 'API\PublicEnAPIController@getBrandbyType');

    Route::get('/getBrandDetail/{seotitle}', 'API\PublicEnAPIController@getBrandDetail');

    Route::get('/getTypewithChild', 'API\PublicEnAPIController@getTypewithChild');

    Route::get('/getBrandwithChild', 'API\PublicEnAPIController@getBrandwithChild');


    /*testimony*/
    Route::get('/getTestimony', 'API\PublicEnAPIController@getTestimony');

    Route::get('/getTestimonyDetail/{seotitle}', 'API\PublicEnAPIController@getTestimonyDetail');


    /*Document*/
    Route::get('/getDocumentCatalog', 'API\PublicEnAPIController@getDocumentCatalog');

    Route::get('/getDocumentArticles', 'API\PublicEnAPIController@getDocumentArticles');

    Route::get('/getShareHoldingStructure', 'API\PublicEnAPIController@getShareHoldingStructure');

    Route::get('/getOrganizationStructure', 'API\PublicEnAPIController@getOrganizationStructure');

    Route::get('/getKoperasiStructure', 'API\PublicEnAPIController@getKoperasiStructure');

    Route::get('/getProductCatalog', 'API\PublicEnAPIController@getProductCatalog');


    Route::get('/getDocumentShareholder', 'API\PublicEnAPIController@getDocumentShareholder');

    Route::get('/getDocumentFinancial', 'API\PublicEnAPIController@getDocumentFinancial');

    Route::get('/getDocumentAnnualReport', 'API\PublicEnAPIController@getDocumentAnnualReport');

    Route::get('/getDocumentProspectus', 'API\PublicEnAPIController@getDocumentProspectus');

    Route::get('/getDocumentCompanyPresentation', 'API\PublicEnAPIController@getDocumentCompanyPresentation');

    Route::get('/getDocumentOthers', 'API\PublicEnAPIController@getDocumentOthers');

    Route::get('/getDocumentCharter', 'API\PublicEnAPIController@getDocumentCharter');


    Route::get('/getDocumentShareInfo', 'API\PublicEnAPIController@getDocumentShareInfo');

    Route::get('/getDocumentRiskManagement', 'API\PublicEnAPIController@getDocumentRiskManagement');


    Route::get('/getDividen', 'API\PublicEnAPIController@getDividen');

    Route::get('/getSharebyOwnership', 'API\PublicEnAPIController@getSharebyOwnership');

    Route::get('/getSharebyComposition', 'API\PublicEnAPIController@getSharebyComposition');

    Route::get('/getSharebyPosition', 'API\PublicEnAPIController@getSharebyPosition');


    Route::get('/getShareInfo', 'API\PublicEnAPIController@getShareInfo');

    Route::get('/getDocumentPressRelease', 'API\PublicEnAPIController@getDocumentPressRelease');

    Route::get('/getLatestArticle', 'API\PublicEnAPIController@getLatestArticle');

    Route::get('/getTermCondition', 'API\PublicEnAPIController@getTermCondition');

    Route::get('/getPrivacy', 'API\PublicEnAPIController@getPrivacy');

    Route::get('/getUniqueWorkingEnvironment', 'API\PublicEnAPIController@getUniqueWorkingEnvironment');

    Route::get('/getDistributionLocal', 'API\PublicEnAPIController@getDistributionLocal');

    Route::get('/getDistributionInternational', 'API\PublicEnAPIController@getDistributionInternational');

    Route::get('/search','API\PublicEnAPIController@search');

});

/** post data */
Route::post('/saveContact','API\PublicAPIController@saveContact');

Route::post('/saveCareerRecruitment','API\PublicAPIController@saveCareerRecruitment');

Route::post('/saveCareerRecruitment2','API\PublicAPIController@saveCareerRecruitment2');

Route::post('/saveInvestor','API\PublicAPIController@saveInvestor');

Route::post('/login', 'API\AuthAPIController@login');

Route::post('/signup', 'API\AuthAPIController@signup');







