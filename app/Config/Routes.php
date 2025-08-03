<?php

use CodeIgniter\Router\RouteCollection;






/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');


$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);


/**
 * AuthModule
 */
require APPPATH . 'Modules/OrganizationModule/Config/Routes.php';

/**
 * AuthModule
 */
require APPPATH . 'Modules/AuthModule/Config/Routes.php';

/**
 * GuardModule
 */
require APPPATH . 'Modules/GuardModule/Config/Routes.php';

/**
 * AnalyzerModule
 */
require APPPATH . 'Modules/AnalyzerModule/Config/Routes.php';

/**
 * AdviserModule
 */
require APPPATH . 'Modules/AdviserModule/Config/Routes.php';

/**
 * ApiModule
 */
require APPPATH . 'Modules/ApiModule/Config/Routes.php';

/**
 * AttachmentModule
 */
require APPPATH . 'Modules/AttachmentModule/Config/Routes.php';


/**
 * AuditTrailModule
 */
require APPPATH . 'Modules/AuditTrailModule/Config/Routes.php';

/**
 * BugReportModule
 */
require APPPATH . 'Modules/BugReportModule/Config/Routes.php';

/**
 * ClientModule
 */
require APPPATH . 'Modules/ClientModule/Config/Routes.php';


/**
 * CommentModule
 */
require APPPATH . 'Modules/CommentModule/Config/Routes.php';

/**
 * DashboardModule
 */
require APPPATH . 'Modules/DashboardModule/Config/Routes.php';

/**
 * DeadlineModule
 */
require APPPATH . 'Modules/DeadlineModule/Config/Routes.php';

/**
 * DocumentationModule
 */
require APPPATH . 'Modules/DocumentationModule/Config/Routes.php';

/**
 * MonitoringModule
 */
require APPPATH . 'Modules/MonitoringModule/Config/Routes.php';

/**
 * NotificationModule
 */
require APPPATH . 'Modules/NotificationModule/Config/Routes.php';

/**
 * ProjectModule
 */
require APPPATH . 'Modules/ProjectModule/Config/Routes.php';

/**
 * ResolutionModule
 */
require APPPATH . 'Modules/ResolutionModule/Config/Routes.php';


/**
 * TechTeamModule
 */
require APPPATH . 'Modules/TechTeamModule/Config/Routes.php';

/**
 * TimelineModule
 */
require APPPATH . 'Modules/TimelineModule/Config/Routes.php';


/**
 * WebhookModule
 */
require APPPATH . 'Modules/WebhookModule/Config/Routes.php';
