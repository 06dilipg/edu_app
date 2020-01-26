<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['dashboard'] = 'admin/Dashboard';
$route['openAdmission'] = 'admin/OpenAdmission';
$route['saveAdmission'] = 'admin/OpenAdmission/saveAdmission';
$route['viewAdmissions'] = 'admin/OpenAdmission/viewAdmissions';
$route['editAdmission/(:num)'] = 'admin/OpenAdmission/editAdmission/$1';
$route['viewApplicationList'] = 'admin/OpenAdmission/viewApplicationList';
$route['viewApplication/(:num)'] = 'admin/OpenAdmission/viewApplication/$1';
$route['admittedCandidates'] = 'admin/ManageApplication/admittedCandidates';
$route['createApplicant/(:num)'] = 'admin/ManageApplication/createApplicant/$1';
$route['submitApplicant'] = 'admin/ManageApplication/submitApplicant';
$route['updateApplicant'] = 'admin/ManageApplication/updateApplicant';
$route['editApplication/(:num)'] = 'admin/ManageApplication/editApplication/$1';
$route['updateApplicationStatus'] = 'admin/ManageApplication/updateApplicationStatus';
$route['contractLetter'] = 'admin/ManageApplication/contractLetter';
$route['saveContractLetter'] = 'admin/ManageApplication/saveContractLetter';
$route['enrollCandidate/(:num)'] = 'admin/ManageApplication/enrollCandidate/$1';
$route['saveDocumentCollectedInfo/(:num)'] = 'admin/ManageApplication/saveDocumentCollectedInfo/$1';
$route['acknowledgementLetter'] = 'admin/ManageApplication/acknowledgementLetter';

$route['momInvite'] = 'admin/Crm/momInvite';
$route['listMOM'] = 'admin/Crm/listMOM';
$route['viewMOM/(:num)'] = 'admin/Crm/viewMOM/$1';
$route['meetingInvitation'] = 'admin/Crm/meetingInvitation';
$route['submitActionPlan'] = 'admin/Crm/submitActionPlan';
$route['phoneEnquiry'] = 'admin/Crm/phoneEnquiry';
$route['submitPhoneEnquiry'] = 'admin/Crm/submitPhoneEnquiry';
$route['listPhoneEnquiries'] = 'admin/Crm/listPhoneEnquiries';
$route['viewPhoneEnquiry/(:num)'] = 'admin/Crm/viewPhoneEnquiry/$1';

$route['viewAgentApplicationList'] = 'admin/OpenAdmission/viewAgentApplicationList';
$route['createAgent'] = 'admin/Agent/createAgent';

$route['manageUser'] = 'admin/Admin/manageUser';
$route['getDesignation'] = 'admin/ManageUser/getDesignation';
$route['saveBasicDetails/(:num)'] = 'admin/ManageUser/saveBasicDetails/$1';
$route['saveAddress/(:num)'] = 'admin/ManageUser/saveAddress/$1';
$route['saveFamily/(:num)'] = 'admin/ManageUser/saveFamily/$1';
$route['saveEducation/(:num)'] = 'admin/ManageUser/saveEducation/$1';
$route['saveWork/(:num)'] = 'admin/ManageUser/saveWork/$1';
$route['uploadSupportingDocs/(:num)'] = 'admin/ManageUser/uploadSupportingDocs/$1';
$route['viewUser/(:num)'] = 'admin/ManageUser/viewUser/$1';
$route['activateUser/(:num)'] = 'admin/ManageUser/activateUser/$1';
$route['deActivateUser/(:num)'] = 'admin/ManageUser/deActivateUser/$1';
$route['manageRole'] = 'admin/Admin/manageRole';
$route['manageDepartment'] = 'admin/Admin/manageDepartment';
$route['saveDepartment'] = 'admin/Admin/saveDepartment';
$route['manageDesignation'] = 'admin/Admin/manageDesignation';
$route['saveDesignation'] = 'admin/Admin/saveDesignation';
$route['manageCourse'] = 'admin/Admin/manageCourse';
$route['saveCourse'] = 'admin/Admin/saveCourse';
$route['viewBatch'] = 'admin/Admin/viewBatch';
$route['saveBatch'] = 'admin/Admin/saveBatch';
$route['manageSubject'] = 'admin/Admin/manageSubject';
$route['saveBatchYear'] = 'admin/Admin/saveBatchYear';
$route['saveSubject'] = 'admin/Admin/saveSubject';
$route['viewSubject'] = 'admin/Admin/viewSubject';
$route['getBatchYear'] = 'admin/Admin/getBatchYear';
$route['manageExam'] = 'admin/Admin/manageExam';
$route['saveExam'] = 'admin/Admin/saveExam';
$route['saveExamSubject'] = 'admin/Admin/saveExamSubject';
$route['viewExamSubject'] = 'admin/Admin/viewExamSubject';

//EVENTS

$route['manageEvent'] = 'admin/ManageEvent';
$route['viewEvents'] = 'admin/ManageEvent/viewEvents';
$route['manageTransport'] = 'admin/ManageTransport';

//TRANSPORT

$route['vehicleList'] = 'admin/ManageTransport/vehicleList';
$route['vehicleInfo/(:num)'] = 'admin/ManageTransport/vehicleInfo/$1';
$route['submitVehicleDetails'] = 'admin/ManageTransport/submitVehicleDetails';
$route['viewVehicleDetails/(:num)'] = 'admin/ManageTransport/viewVehicleDetails/$1';
$route['submitServiceDetails/(:num)'] = 'admin/ManageTransport/submitServiceDetails/$1';
$route['submitFuelDetails/(:num)'] = 'admin/ManageTransport/submitFuelDetails/$1';
$route['viewServiceDetails/(:num)'] = 'admin/ManageTransport/viewServiceDetails/$1';
$route['uploadVehicleDocs/(:num)'] = 'admin/ManageTransport/uploadVehicleDocs/$1';
$route['uploadServiceDocs/(:num)'] = 'admin/ManageTransport/uploadServiceDocs/$1';
$route['uploadFuelDocs/(:num)'] = 'admin/ManageTransport/uploadFuelDocs/$1';

//INVENTORY

$route['manageInventory'] = 'admin/ManageInventory';
$route['addPurchase'] = 'admin/ManageInventory/addPurchase';
$route['listPurchase'] = 'admin/ManageInventory/listPurchase';
$route['addStock'] = 'admin/ManageInventory/addStock';
$route['listStock'] = 'admin/ManageInventory/listStock';
$route['outStock'] = 'admin/ManageInventory/outStock';
$route['outstockList'] = 'admin/ManageInventory/outstockList';

$route['timetableSchedule'] = 'academic/Attendance/timetableSchedule';
$route['takeAttendance/(:num)/(:num)'] = 'academic/Attendance/takeAttendance/$1/$2';
$route['saveAttendance'] = 'academic/Attendance/saveAttendance';
$route['currentBatchYear'] = 'academic/Timetable/currentBatchYear';
$route['regularTimetable/(:num)/(:num)/(:num)'] = 'academic/Timetable/regularTimetable/$1/$2/$3';
$route['saveTimeTable'] = 'academic/Timetable/saveTimeTable';
$route['additionalDuty'] = 'academic/Timetable/additionalDuty';
$route['feedExamResult'] = 'academic/ExamResults/feedExamResult';

$route['admissionSlots'] = 'welcome/admissionSlots';
$route['visitors'] = 'welcome/visitors';
$route['register'] = 'welcome/register';
$route['submitRegistration'] = 'welcome/submitRegistration';
$route['forgotPassword'] = 'welcome/forgotPassword';
$route['changePasswordEmail'] = 'welcome/changePasswordEmail';
$route['reSetPassword'] = 'welcome/reSetPassword';
$route['login'] = 'welcome/login';
$route['logout'] = 'welcome/logout';
$route['postApplicant'] = 'welcome/postApplicant';
$route['fillApplication/(:num)'] = 'welcome/fillApplication/$1';
$route['submitApplication'] = 'welcome/submitApplication';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
