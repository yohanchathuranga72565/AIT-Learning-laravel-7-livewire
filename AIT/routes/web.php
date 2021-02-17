<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/about','HomePages\AboutController@index')->name('home.about');
Route::get('/contact','HomePages\ContactController@index')->name('home.contact');
Route::get('/', 'HomePages\HomeController@index')->name('home.home');
Route::post('/send-email','HomePages\ContactController@sendEmail' )->name('contact-mail');
Route::get('/allowPermisionSubject/{sid}/{tid}','HomePages\HomeController@allowPermisionSubject');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::resource('admin', 'Admin\AdminController');
// Route::post('/adminProfileUpload','Admin\AdminController@profileUpload')->name('adminProfileUpload');



Route::resource('teacher', 'Teacher\TeacherController');
// Route::post('/teacherProfileUpload','Teacher\TeacherController@profileUpload')->name('teacherProfileUpload');
Route::get('/allTeacherDetails','Teacher\TeacherController@getAllDetails')->name('teacherGetAllDetails');
Route::get('/classes','Teacher\TeacherController@showClasses')->name('showClasses');
// Route::get('/attendance','Teacher\TeacherController@attendanceShowClasses')->name('attendanceShowClasses');
Route::get('/resources','Teacher\TeacherController@resourcesShowClasses')->name('resourcesShowClasses');
Route::get('/resourcesUploadForm/{grade}','Teacher\TeacherController@resourcesUploadForm')->name('resourcesUploadForm');
Route::post('/resourcesUpload/{grade}','Teacher\TeacherController@resourcesUpload')->name('resourcesUpload');
Route::post('/addClass','Teacher\TeacherController@addClasses')->name('addClasses');
Route::get('/viewResources/{grade}/{teacher}','Teacher\TeacherController@viewResources')->name('viewResources');
Route::get('/showResources/{id}','Teacher\TeacherController@showResources')->name('showResources');
Route::get('/editResourcesForm/{id}','Teacher\TeacherController@editResourcesForm')->name('editResourcesForm');
Route::post('/editResources/{id}','Teacher\TeacherController@editResources')->name('editResources');
Route::get('/editResourcesFile/{id}','Teacher\TeacherController@editResourcesFileForm')->name('editResourcesFileForm');
Route::post('/editResourcesFile/{id}','Teacher\TeacherController@editResourcesFile')->name('editResourcesFile');
Route::get('/deleteResources/{id}','Teacher\TeacherController@deleteResources')->name('deleteResources');
Route::get('/gradeStudent/{id}','Teacher\TeacherController@showGradeStudentList')->name('gradeStudent');
Route::get('/quizes','Teacher\TeacherController@quizes')->name('quizes');
Route::get('/showCourses','Teacher\TeacherController@showCreateCoursePage')->name('showCourse');
Route::get('/createCourses','Teacher\TeacherController@showCreateCourseform')->name('createCourse');
Route::post('/addCourse','Teacher\TeacherController@addCourses')->name('addCourses');
Route::get('/addCourseContentForm/{id}','Teacher\TeacherController@addCourseContentForm')->name('addCourseContent');
Route::post('/saveCourseContent/{id}','Teacher\TeacherController@saveCourseContent')->name('saveCourseContent');
Route::get('/showCourseContent/{id}','Teacher\TeacherController@showCourseContent')->name('showCourseContent');
Route::get('/viewCourseEpisoid/{id}','Teacher\TeacherController@viewCourseEpisoid')->name('viewCourseEpisoid');
Route::get('/deleteCourseEpisoid/{id}','Teacher\TeacherController@deleteCourseEpisoid')->name('deleteCourseEpisoid');
Route::get('/coursePayment/{id}','Teacher\TeacherController@coursePayment')->name('coursePayment');
Route::get('/saveCoursePayment/{id}','Teacher\TeacherController@saveCoursePayment')->name('saveCoursePayment');
Route::get('/publishCourse/{id}','Teacher\TeacherController@publishCourse')->name('publishCourse');
Route::get('/assignments','Teacher\TeacherController@assignmentsShowClasses')->name('assignmentsShowClasses');
Route::get('/assignmentCreatedForm/{gid}','Teacher\TeacherController@assignmentCreatedForm')->name('assignmentCreatedForm');
Route::post('/createAssingnment/{gid}','Teacher\TeacherController@createAssingnment')->name('createAssingnment');
Route::get('/viewSubmissions/{grade}/{teacher}','Teacher\TeacherController@viewSubmissions')->name('viewSubmissions');
Route::get('/publishLink/{aid}','Teacher\TeacherController@publishLink')->name('publishLink');
Route::get('/submissions/{aid}','Teacher\TeacherController@allSubmission')->name('submission');
Route::get('/downloadAllsubmissions/{aid}','Teacher\TeacherController@downloadAllSubmissions')->name('downloadAllSUbmissions');
Route::get('/downloadOneSubmission/{sid}','Teacher\TeacherController@downloadOneSubmission')->name('downloadOneSubmission');
Route::get('/editAssignmentForm/{aid}','Teacher\TeacherController@editAssignmentForm')->name('editAssignmentForm');
Route::post('/editAssignment/{aid}','Teacher\TeacherController@editAssignment')->name('editAssignment');



Route::resource('student', 'Student\StudentController');
// Route::post('/studentProfileUpload','Student\StudentController@profileUpload')->name('studentProfileUpload');
Route::get('/allStudentDetails','Student\StudentController@getAllDetails')->name('studentGetAllDetails');
Route::get('/subjects','Student\StudentController@showSubjects')->name('showSubjects');
Route::post('/getPermisionSubject','Student\StudentController@getPermisionSubject')->name('getPermisionSubject');
Route::get('/assignments/{tid}','Student\StudentController@assignments')->name('assignments');
Route::get('/assignmentView/{file}','Student\StudentController@assignmentView')->name('assignmentView');
Route::get('/uploadAssignment/{aid}','Student\StudentController@uploadAssignment')->name('uploadAssignment');
Route::post('/uploadAssignment/{aid}','Student\StudentController@saveAssignment')->name('saveAssignment');
Route::post('/deleteInDropbox/{aid}','Student\StudentController@removeAssignmentInDropbox')->name('deleteInDropbox');




Route::resource('parent', 'Parent\ParentController');
// Route::post('/parentProfileUpload','Parent\ParentController@profileUpload')->name('parentProfileUpload');
Route::get('/allParentDetails','Parent\ParentController@getAllDetails')->name('parentGetAllDetails');
Route::get('/linkStudentToParent/{id}','Parent\ParentController@linkStudent')->name('linkStudent');
Route::get('/linkedStudentList/{id}','Parent\ParentController@getLinkedStudent')->name('getLinkedStudent');

Route::get('/comments','ChatSystem\CommentController@index')->name('comments');

