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
$route['default_controller']                              = 'home_controller';
$route['404_override']                                    = '';
$route['translate_uri_dashes']                            = FALSE;


$route['home']['GET']                                     = 'home_controller/index';
$route['home']['POST']                                    = 'home_controller/control';
$route['home/logout']['GET']                              = 'home_controller/logout';


$route['departments']['GET']                              = 'departments_controller/index';
$route['departments/new']['GET']                          = 'departments_controller/add';
$route['departments/new']['POST']                         = 'departments_controller/create';
$route['departments/edit/(:any)']['GET']                  = 'departments_controller/edit/$1';
$route['departments/edit/(:any)']['POST']                 = 'departments_controller/update/$1';
$route['departments/delete/(:any)']['GET']                = 'departments_controller/delete/$1';


$route['activities']['GET']                               = 'activities_controller/index';
$route['activities/new']['GET']                           = 'activities_controller/add';
$route['activities/new']['POST']                          = 'activities_controller/create';
$route['activities/edit/(:any)']['GET']                   = 'activities_controller/edit/$1';
$route['activities/edit/(:any)']['POST']                  = 'activities_controller/update/$1';
$route['activities/delete/(:any)']['GET']                 = 'activities_controller/delete/$1';


$route['card_activities']['GET']                          = 'card_activities_controller/index';
$route['card_activities/new']['GET']                      = 'card_activities_controller/add';
$route['card_activities/new']['POST']                     = 'card_activities_controller/create';
$route['card_activities/edit/(:any)']['GET']              = 'card_activities_controller/edit/$1';
$route['card_activities/edit/(:any)']['POST']             = 'card_activities_controller/update/$1';
$route['card_activities']['POST']                         = 'card_activities_controller/search';//arama işlemi
$route['card_activities/delete/(:any)']['GET']            = 'card_activities_controller/delete/$1';
$route['card_activities/find']['POST']                    = 'card_activities_controller/find';//raspberry
$route['card_activities/approve/(:any)']['GET']           = 'card_activities_controller/approve/$1';//jquery onaylama


$route['cards']['GET']                                    = 'cards_controller/index';
$route['cards/new']['GET']                                = 'cards_controller/add';
$route['cards/new']['POST']                               = 'cards_controller/create';
$route['cards/edit/(:any)']['GET']                        = 'cards_controller/edit/$1';
$route['cards/edit/(:any)']['POST']                       = 'cards_controller/update/$1';
$route['cards/delete/(:any)']['GET']                      = 'cards_controller/delete/$1';


$route['job_rotations']['GET']                            = 'job_rotations_controller/index';
$route['job_rotations/new']['GET']                        = 'job_rotations_controller/add';
$route['job_rotations/new']['POST']                       = 'job_rotations_controller/create';
$route['job_rotations/edit/(:any)']['GET']                = 'job_rotations_controller/edit/$1';
$route['job_rotations/edit/(:any)']['POST']               = 'job_rotations_controller/update/$1';
$route['job_rotations/delete/(:any)']['GET']              = 'job_rotations_controller/delete/$1';

$route['personels']['GET']                                = 'personels_controller/index';
$route['personels/new']['GET']                            = 'personels_controller/add';
$route['personels/new']['POST']                           = 'personels_controller/create';
$route['personels/edit/(:any)']['GET']                    = 'personels_controller/edit/$1';
$route['personels/edit/(:any)']['POST']                   = 'personels_controller/update/$1';
$route['personels/delete/(:any)']['GET']                  = 'personels_controller/delete/$1';
$route['personels/archive/(:any)']['GET']                 = 'personels_controller/archive/$1';

$route['personel_activities']['GET']                      = 'personel_activities_controller/index';
$route['personel_activities']['POST']                     = 'personel_activities_controller/search';//arama işlemi
$route['personel_activities/new']['GET']                  = 'personel_activities_controller/add';
$route['personel_activities/new']['POST']                 = 'personel_activities_controller/create';
$route['personel_activities/edit/(:any)/(:any)']['GET']   = 'personel_activities_controller/edit/$1/$2';
$route['personel_activities/edit/(:any)/(:any)']['POST']  = 'personel_activities_controller/update/$1/$2';
$route['personel_activities/delete/(:any)/(:any)']['GET'] = 'personel_activities_controller/delete/$1/$2';


$route['archive_personels']['GET']             			  = 'archive_personels_controller/index';
$route['archive_cards']['GET']			             	  = 'archive_cards_controller/index';

$route['archive_card_activities']['GET']              	  = 'archive_card_activities_controller/index';
$route['archive_card_activities']['POST']                 = 'archive_card_activities_controller/search';//arama işlemi

$route['archive_personel_activities']['GET']              = 'archive_personel_activities_controller/index';
$route['archive_personel_activities']['POST']             = 'archive_personel_activities_controller/search';