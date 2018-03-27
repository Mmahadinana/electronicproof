 <?php
 defined('BASEPATH') OR exit('No direct script access allowed');

$type=array('type'=>1,
                        'comments'=>$_SESSION['name'].' has Canceled request, click to view',
                        'subjects'=>'User Request Canceled',
                            );
$comments=array(
    'type'=>array(1,2,3,4),
    'comments'          =>array(),
    'subjects'          =>array(
                'request'       =>array('create'=>'made a request',
                'cancel'        =>'canceled request',
                'confirm'       =>'Owner confirmed request',
                'not_confirm'   =>'Owner declined request',
                'disapproved'   =>'Request was not approved',
                'approved'      =>'Request has been approved'),
        'change_address' =>array('add','delete','remove','delete','disapproved','approved'),
        'messages'       =>array('create','cancel','confirm','not_confirm','disapproved','approved'),
        'property'       =>array('create','cancel','confirm','not_confirm','disapproved','approved'),
                        ),)

 $comment=array(
         1 =>array(
            1=>array(
               'create'     =>'made a request',
               'cancel'     =>'canceled request',
               'confirm'    =>'Owner confirmed request',
               'not_confirm'=>'Owner declined request',
               'disapproved'=>'Request was not approved',
               'approved'   =>'Request has been approved',
             )),
         2 =>array(
            1=>array(
               'create'     =>'made a request',
               'cancel'     =>'canceled request',
               'confirm'    =>'Owner confirmed request',
               'not_confirm'=>'Owner declined request',
               'disapproved'=>'Request was not approved',
               'approved'   =>'Request has been approved',
             )),
        3 =>array(
            1=>array(
               'create'     =>'made a request',
               'cancel'     =>'canceled request',
               'confirm'    =>'Owner confirmed request',
               'not_confirm'=>'Owner declined request',
               'disapproved'=>'Request was not approved',
               'approved'   =>'Request has been approved',
             )),
        4 =>array(
            1=>array(
               'create'     =>'made a request',
               'cancel'     =>'canceled request',
               'confirm'    =>'Owner confirmed request',
               'not_confirm'=>'Owner declined request',
               'disapproved'=>'Request was not approved',
               'approved'   =>'Request has been approved',
             )),
 );
 
 

 
 ?>