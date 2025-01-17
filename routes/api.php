<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\MidtermMarkController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ExamScheduleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChanceController;
use App\Http\Controllers\FinalMarkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\WeekDayController;
use App\Http\Controllers\FinalProjectController;
use App\Http\Controllers\RelativeController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepeatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// **  Attendance Routes
Route::apiResource('attendances', AttendanceController::class);
Route::delete('attendances/attendance/{id}', [AttendanceController::class, 'permanentDelete']);
Route::get('attendances/{id}/restore', [AttendanceController::class, 'restore']);
Route::post('attendances/find-by-subject-year-month/', [AttendanceController::class, 'getAttBySubjectYearMonth']);
Route::post('attendances/find-by-student-month/', [AttendanceController::class, 'getAttByStudentMonth']);
Route::post('attendances/find-by-subject-period', [AttendanceController::class, 'getStudentsBySubjectPeriod']);

// ** Address Routes
Route::apiResource('addresses', AddressController::class);
Route::delete('addresses/address/{id}', [AddressController::class, 'permanentDelete']);
Route::get('addresses/{id}/restore', [AddressController::class, 'restore']);


// ** Chance Routes
Route::apiResource('chances', ChanceController::class);
Route::delete('chances/chance/{id}', [ChanceController::class, 'permanentDelete']);
Route::get('chances/{id}/restore', [ChanceController::class, 'restore']);


// ** Dashboard Routes
Route::get('dashboard', DashboardController::class);
// there should be a route for inserting user photo aswell


// ** Exam_Schedule Routes
Route::apiResource('exam-schedules', ExamScheduleController::class);
Route::delete('exam-schedules/exam-schedule/{id}', [ExamScheduleController::class, 'permanentDelete']);
Route::get('exam-schedule/{id}/restore', [ExamScheduleController::class, 'restore']);


// ** Final Mark Routes
Route::apiResource('final-marks', FinalMarkController::class);
Route::delete('final-marks/final-mark/{id}', [FinalMarkController::class, 'permanentDelete']);
Route::get('final-marks/{id}/restore', [FinalMarkController::class, 'restore']);
Route::post('mark/final-marks-print', [FinalMarkController::class, 'loadMarks']);


// ** Final Project Routes
Route::apiResource('final-projects', FinalProjectController::class);
Route::delete('final-projects/final-project/{id}', [FinalProjectController::class, 'permanentDelete']);
Route::get('final-projects/{id}/restore', [FinalProjectController::class, 'restore']);
Route::get('final-projects/get-students-by-project/{id}', [FinalProjectController::class, 'getFinalProjectStudents']);
Route::get('final-projects/get-teacher-by-project/{id}', [FinalProjectController::class, 'getFinalProjectTeacher']);
Route::post('final-projects/add-student-list', [FinalProjectController::class, 'addStudentToFinalProject']);
Route::post('final-projects/filter', [FinalProjectController::class, 'project_filter']);


// ** Login
Route::post('/login', [AuthenticationController::class, 'login']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// ** Midterm Mark Routes
Route::apiResource('mid-term-marks', MidtermMarkController::class);
Route::delete('mid-term-marks/mid-term-mark/{id}', [MidtermMarkController::class, 'permanentDelete']);
Route::get('mid-term-marks/{id}/restore', [MidtermMarkController::class, 'restore']);
Route::post('mid-term-marks/mark-assign-students', [SemesterController::class, 'find_all_students']);


// ** Using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});


// ** Relative Routes
Route::apiResource('relatives', RelativeController::class);
Route::delete('relatives/relative/{id}', [RelativeController::class, 'permanentDelete']);
Route::get('relatives/{id}/restore', [RelativeController::class, 'restore']);


// ** Registration Routes
Route::apiResource('registrations', RegistrationController::class);
Route::delete('registrations/registration/{id}', [RegistrationController::class, 'permanentDelete']);


// ** Schedule Routes
Route::apiResource('schedules', ScheduleController::class);
Route::delete('schedules/schedule/{id}', [ScheduleController::class, 'permanentDelete']);
Route::get('schedules/{id}/restore', [ScheduleController::class, 'restore']);
Route::post('schedules/schedule-filter', [ScheduleController::class, 'scheduleFilter']);
Route::get('schedules/get-schedule-by-semester/{id}', [ScheduleController::class, 'getScheduleBySemester']);


// ** Subject routes
Route::apiResource('subjects', SubjectController::class);
Route::delete('subjects/subject/{id}', [SubjectController::class, 'permanentDelete']);
Route::get('subjects/{id}/restore', [SubjectController::class, 'restore']);
Route::post('subjects/add-student', [SubjectController::class, 'addStudentToSubject']);
Route::get('get-semesters', [SubjectController::class, 'getSemesters']);


// ** Student Routes
Route::apiResource('/students', StudentController::class);
Route::delete('students/student/{id}', [StudentController::class, 'permanentDelete']);
Route::get('students/{id}/restore', [StudentController::class, 'restore']);
Route::get('students/get-father-name/{name}', [StudentController::class, 'studentFatherName']);
Route::get('students/get-roll-no/{fname}', [StudentController::class, 'studentRollNo']);
Route::post('students/find-by-email', [StudentController::class, 'findByEmail']);
Route::post('students/find-by-subject-period/', [StudentController::class, 'getStudentsBySubjectPeriod']);
Route::get('students/find-by-semester/{id}', [StudentController::class, 'getStudentsBySemester']);
Route::post('students/add-to-semester', [StudentController::class, 'addStudentToSemester']);
Route::get('students/get-relatives/{id}', [StudentController::class, 'getStudentRelatives']);


// ** Semester Routes
Route::apiResource('semesters', SemesterController::class);
Route::delete('semesters/semester/{id}', [SemesterController::class, 'permanentDelete']);
Route::get('semesters/{id}/restore', [SemesterController::class, 'restore']);
Route::get('semesters/find-by-name', [SemesterController::class, 'findByNumber']);
Route::post('semesters/funded-students', [SemesterController::class, 'getFundedStudentsBySemester']);
Route::post('semester/find-all-students-of-semester', [SemesterController::class, 'find_all_students_of_semester']);


// ** Teacher Routes
Route::apiResource('teachers', TeacherController::class);
Route::delete('teachers/teacher/{id}', [TeacherController::class, 'permanentDelete']);
Route::get('teachers/{id}/restore', [TeacherController::class, 'restore']);
Route::post('teachers/find-by-email', [TeacherController::class, 'findByEmail']);


// ** WeekDay Routes
Route::apiResource('week-days', WeekDayController::class);
Route::post('week-days/get-subjects', [WeekDayController::class, 'getSubjectsByWeekDay']);


// ** Repeat Routes
Route::apiResource('repeats', RepeatController::class);