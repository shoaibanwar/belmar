<?php
  /**
   * Language File
   *
   * @package HollyCode CMS
   * English
   * @author HollyCode.com
   * @copyright 2010
   * @version $Id: language.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php

  // Global
  define('_SUBMIT', 'Submit');
  define('_DOWNLOAD', 'Download');
  define('_CANCEL', 'Cancel');
  define('_EDIT', 'Edit');
  define('_DELETE', 'Delete');
define('Delete','Delete');
  define('_CUT', 'Cut');
  define('_COPY', 'Copy');
  define('_PASTE', 'Paste');
  define('_CHMOD', 'CHMOD');
  define('_UPLOAD', 'Upload');
  define('_PUBLIC', 'Public');
  define('_DAYS', 'Day(s)');
  define('_WEEKS', 'Week(s)');
  define('_MONTHS', 'Month(s)');
  define('_YEARS', 'Year(s)');
  define('_REGISTERED', 'Registered');
  define('_REFRESH', 'Refresh');
  define('_FREE', '<span style="color:red">FREE</span>');
  define('_YES', 'Yes');
  define('_NO', 'No');
  define('_SAVE', 'Save');
  define('_BACK', 'back');
  define('_CREATED', 'Added On');
  define('_GALTYPE', 'Type');
  define('_PUBLISHED', 'Status');
  define('_NOTPUBLISHED', 'Not Published');
  define('_USERNAME', 'Username');
  define('_GROUPNAME', 'Department / Group Name');
  define('_GROUP', 'Department / Group');
  define('_NOLOGS', 'No logs available for this user.');
  define('_PASSWORD', 'Password');
  define('_PAGE_NOT_FOUND', '<span>Alert!</span>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable!');
  define('_CONTENT_NOT_FOUND', '<div class="msgAlert"><span>Alert!</span>No Content found under this page !.</div>');
  define('_SYSTEM_ERR', '<span>Error!</span>An error occurred while processing request');
  define('_SYSTEM_PROCCESS', '<span>Alert!</span>Nothing to process.');
  define('_REQ_FIELD', 'Required Field.');
  define('_ACTIONS', 'Actions');
  define('_DEL_CONFIRM', 'Are you sure you want to delete this record?<br /><strong>This action cannot be undone!!!</strong>');
  define('_DEL_CONFIRM_GROUP', 'Are you sure you want to delete this record?<br /><p style="color:red;">All users associated with this department will be deleted!</p><strong>This action cannot be undone!!!</strong>');
  define('_REQ1', ' Fields marked ');
  define('_REQ2', ' are required.');
define('page_title','Page Title');
  define('_CON_PAGE', 'Content Page');
  define('_EXT_LINK', 'External Link');
  define('_HOME', 'Home');
  define('_YOUAREHERE', 'You are here');
  define('_MENU', 'Menu');
  define('_PAGE', 'Page');
  define('_ADD_TO_PAGE', 'Add to Page');
  define('_POST', 'Post');
  define('_MODULE', 'Module');
  define('_PLUGIN', 'Plugin');
  define('_GALLERY', 'Gallery');
  define('_MEMBERSHIP', 'Membership');
  define('_TRANSACTION', 'Transaction');
  define('_LANGUAGE', 'Language');
  define('_METAKEYS', 'Meta Keywords');
  define('_METADESC', 'Meta Description');
  define('_IMAGE', 'Image');
  define('_USER', 'User');
  define('_SUBADMIN', 'Sub-Admin');
  define('_DEP', 'Department');
  define('_USER_A', 'User Active');
  define('_EVENT_A', 'Event featured');
  define('_DEPARTMENT_A', 'Active');
  define('_USER_I', 'User Inactive');
  define('_EVENT_I', 'Event not featured');
  define('_DEPARTMENT_I', 'Inactive');
  define('_USER_P', 'User Pending');
  define('_USER_B', 'User Banned');
  define('_DELETED', 'deleted successfully!');
  define('_UPDATED', 'updated successfully!');
  define('_WELCOME', 'Welcome');

  // Maintenance
  define('_M_WEEKS', 'Weeks');
  define('_M_DAYS', 'Days');
  define('_M_HOURS', 'Hours');
  define('_M_MINUTES', 'Minutes');
  define('_M_SECONDS', 'Seconds');
  define('_M_H1', 'UNDER CONSTRUCTION');
  define('_M_H2', 'Stay tuned for news and updates');
    
  // Months
  define('_JAN', 'January');
  define('_FEB', 'February');
  define('_MAR', 'March');
  define('_APR', 'April');
  define('_MAY', 'May');
  define('_JUN', 'June');
  define('_JUL', 'July');
  define('_AUG', 'August');
  define('_SEP', 'September');
  define('_OCT', 'October');
  define('_NOV', 'November');
  define('_DEC', 'December');

  // Months Short
  define('_JA_', 'Jan');
  define('_FE_', 'Feb');
  define('_MA_', 'Mar');
  define('_AP_', 'Apr');
  define('_MY_', 'May');
  define('_JU_', 'Jun');
  define('_JL_', 'Jul');
  define('_AU_', 'Aug');
  define('_SE_', 'Sep');
  define('_OC_', 'Oct');
  define('_NO_', 'Nov');
  define('_DE_', 'Dec');
  
  // Day Names
  define('_MONDAY', 'Monday');
  define('_TUESDAY', 'Tuesday');
  define('_WEDNESDAY', 'Wednesday');
  define('_THURSDAY', 'Thursday');
  define('_FRIDAY', 'Friday');
  define('_SATURDAY', 'Saturday');
  define('_SUNDAY', 'Sunday');

  // Day Names Short
  define('_MON', 'Mon');
  define('_TUE', 'Tue');
  define('_WED', 'Wed');
  define('_THU', 'Thu');
  define('_FRI', 'Fri');
  define('_SAT', 'Sat');
  define('_SUN', 'Sun');
 
   // Day Names Min
  define('_MO', 'M');
  define('_TU', 'T');
  define('_WE', 'W');
  define('_TH', 'T');
  define('_FR', 'F');
  define('_SA', 'S');
  define('_SU', 'S');

   // Sitemap
  define('_SM_SITE_MAP', 'Site Map');
  define('_SM_SITE_MAP_TITLE', 'Web site at a glance');

   // Search
  define('_SR_SEARCH', 'Search Results');
  define('_SR_SEARCH2', 'Search Results For &rsaquo; ');
  define('_SR_SEARCH_EMPTY', '<span>Info!</span>Sorry, your search for <strong>');
  define('_SR_SEARCH_EMPTY1', '</strong> did not yield any results. Please try searching for similar terms.');
  define('_SR_SEARCH_EMPTY2', '<span>Alert!</span>Please enter some keywords into search box to perform search.');
  define('_SR_SEARCH_GO', 'GO');

   // 404
  define('_ER_404', '404 - Oops! Sorry, couldn\'t find that page');
  define('_ER_404_1', '<span></span>Looks like the page you\'re looking for was moved or never existed. Make sure you typed the correct URL or followed a valid link.
   Use the search above or menu navigation to enter a keyword or phrase to search for content.');
  
   // Admin User Permissions
  define('_UP_POLL', '-- Ajax Poll');
  define('_UP_COMMENTS', '-- Commenting System');
  define('_UP_EVENTS', '-- Event Manager');
  define('_UP_GALLERY', '-- Gallery');
  define('_UP_JSLIDER', '-- jQuery Slider');
  define('_UP_JTABS', '-- jQuery Tabs');
  define('_UP_TWITTS', '-- Latest Twitts');
  define('_UP_NSLIDER', '-- News Slider');
  define('_UP_ACCO', '-- Accordeon');
  define('_UP_RSS', '-- Rss Parser');
  define('_UP_DBACKUP', 'Database Backup');
  
   // Admin Navigation
  define('_N_MENUS', 'Menus');
  define('_N_PAGES', 'Pages');
  define('_N_POSTS', 'Posts');
  define('_N_MODS', 'Modules');
  define('_N_PLUGS', 'Plugins');
  define('_N_MEMBS', 'Memberships');
  define('_N_MEMBSET', 'Membership Setup');
  define('_N_GATES', 'Gateways');
  define('_N_TRANS', 'Transactions');
  define('_N_LAYS', 'Layout');
  define('_N_USERS', 'Users');
  define('_N_GROUPS', 'Departments / Groups');
  define('_N_CONF', 'Configuration');
  define('_N_EMAILS', 'Email Templates');
  define('_N_NEWSL', 'Newsletter');
  define('_N_LANGS', 'Language Manager');
  define('_N_LOGS', 'Log Manager');
  define('_LIMIT_TABS', '# of Items in Featurd Tab');
  define('_PUBLISH_TIME', 'Automatically unpublish items after');
  define('_PUBLISH_TIME_INFO', 'Time until events are removed from front end');
  define('_LIMIT_TABS_INFO', 'Number of events to show in front page');

  define('_HOUR_S', 'Hour(s)');
  
  define('_N_VIEWS', 'View site');
  define('_N_LOGOUT', 'Logout');
  define('_N_BACK', 'Backup');
  define('_N_FM', 'Filemanager');

   // System Logging
  define('_LG_TITLE1', 'Viewing CMS Logs');  
  define('_LG_INFO1', 'Here you can view all your logs.'); 
  define('_LG_SUBTITLE1', 'Latest Activity Logs'); 
  define('_LG_EMPTY', 'Empty Logs'); 
  define('_LG_EMPTY_LOGS', 'Empty Log Table');
  define('_LG_STATS_EMPTY', '<span>Success!</span>Log table is empty!');
  define('_LG_WHEN', 'Date');
  define('_LG_USER', 'User');
  define('_LG_IP', 'IP');
  define('_LG_TYPE', 'Type');
  define('_LG_IMPORTANCE', 'Importance');
  define('_LG_DATA', 'Data');
  define('_LG_DATE', 'Date');
  define('_LG_FILTER', 'Log Filter');
  define('_LG_FILTER_R', '--- Reset Log Filter ---');
  define('_LG_MESSAGE', 'Log Message');
  define('_LG_LOGOUT', 'has successfully logged out.');
  define('_LG_LOGIN', 'has successfully logged in.');
  define('_LG_CONTACT_SENT', 'has successfully submitted contact request.');
  define('_LG_NEWSLETTER_SENT', 'has been successfully subscribed to our mailing list.');
  define('_LG_COMMENT_SENT', 'has successfully submitted new comment.');
  define('_LG_PROFILE_UPDATED', 'has successfully updated profile.');
  define('_LG_PASS_RESET', 'has has requested password reset.');
  define('_LG_USER_REGGED', 'has successfully registered.');
  define('_LG_MEM_ACTIVATED', ' activated for ');
  define('_LG_PAYMENT_OK', 'has successfully purchased');
  define('_LG_PAYMENT_ERR', 'Failed transaction for ');
 
  // User Account/Register/Login/Activation
  define('_UA_TITLE1', 'Manage Your Account');   
  define('_UA_INFO1', '<span>Info!</span>Here you can make changes to your profile, upgrade membership, etc...'); 
  define('_UA_SUBTITLE1', 'User Account Edit'); 
  define('_UA_UPDATE', 'Update Profile'); 
  define('_UA_SEL_MEMBERSHIP', 'Select Your Membership');
  define('_UA_CUR_MEMBERSHIP', 'Current Membership');
  define('_UA_VALID_UNTIL', 'Valid Until');
  define('_UA_NO_MEMBERSHIP', 'No Membership');
  define('_UA_ACTIVATE', 'Activate Membership');
  define('_UA_UPDATEOK', '<span>Success!</span> You have successfully updated your profile.');
  define('_UA_INFO2', 'Member Login');
  define('_UA_TITLE2', 'Account Login');
  define('_UA_SUBTITLE2', '<span>Info!</span>Please enter your valid username and password to login into your account.');
  define('_UA_LOGINNOW', 'Login Now');
  define('_UA_CLICKTOREG', 'Click Here to Register');
  define('_UA_TITLE3', 'Lost Password');
  define('_UA_SUBTITLE3', '<span>Info!</span>Enter your username and email address below to reset your password. A verification token will be sent to your email address.<br />Once you have received the token, you will be able to choose a new password for your account.');
  define('_UA_PASS_RTOTAL', 'Captcha Code');
  define('_UA_PASS_RTOTAL_R', 'Please enter captcha code');
  define('_UA_PASS_RTOTAL_R1', 'Entered captcha code is incorrect');
  define('_UA_PASS_RSUBMIT', 'Submit Request');
  define('_UA_PASS_R_OK', '<span>Success!</span>You have successfully changed your password. Please check your email for further info!');
  define('_UA_PASS_R_ERR', '<span>Error!</span>There was an error during the process. Please contact the administrator.');
  define('_UA_TITLE4', 'User Registration');   
  define('_UA_INFO4', '<span>Info!</span>Please fill out the form below to become registered member.'); 
  define('_UA_SUBTITLE4', 'Create Account'); 
  define('_UA_PASSWORD2', 'Repeat Password'); 
  define('_UA_PASSWORD2_T', 'Password must be at least 6 characters long.'); 
  define('_UA_REG_RTOTAL', 'Captcha Code');
  define('_UA_REG_RTOTAL_R', 'Please enter captcha code.');
  define('_UA_REG_RTOTAL_R1', 'Entered captcha code incorrect.');
  define('_UA_AVATAR_SIZE', 'Uploaded image is larger than 300Kb');
  define('_UA_REG_ACC', 'Register Account');
  define('_UA_NOMORE_REG', '<span>Info!</span>We are sorry, at this point we do not accept any more registrations.');
  define('_UA_MAX_LIMIT', '<span>Info!</span>We are sorry, maximum number of registered users have been reached.');
  define('_UA_REG_ERR', '<span>Error!</span>There was an error during registration process. Please contact the administrator...');
  define('_UA_REG_OK', '<span>Success!</span>You have successfully registered. Please check your email for further information!');
  define('_UA_TITLE5', 'Account Activation');   
  define('_UA_INFO5', '<span>Info!</span>Here you can activate your account. Please enter your email address and activation code received.'); 
  define('_UA_SUBTITLE5', 'Activate Your Account'); 
  define('_UA_TOKEN', 'Activation Token');
  define('_UA_ACTIVATE_ACC', 'Activate Account');
  define('_UA_TOKEN_R', 'This account has been already activated!');
  define('_UA_TOKEN_R1', 'The token code is not valid"');
  define('_UA_TOKEN_OK1', '<span>Success!</span>You have successfully activated your account!');
  define('_UA_TOKEN_OK2', '<span>Success!</span>Your account is now active. However you still need to wait for administrative approval.');
  define('_UA_TOKEN_R_ERR', '<span>Error!</span>There was an error during the activation process. Please contact the administrator.');
  define('_UA_ACC_ERR1', '<span>Error!</span>You must be registered and logged in to access this page.');
  define('_UA_ACC_ERR2', '<span>Error!</span>You must have valid membership to access this page.');
  define('_UA_P_SUMMARY', 'Purchase Summary');
  define('_UA_REGISTER', 'Register');
  define('_UA_LOGIN', 'Login');
         
  // Contact Form
  define('_CF_NAME', 'Your Name');
  define('_CF_FNAME_R', 'Please enter your first name');
  define('_CF_LNAME_R', 'Please enter your last name');
  define('_CF_TOTAL', 'Captcha Code');
  define('_CF_TOTAL_R', 'Please enter captcha code');
  define('_CF_TOTAL_ERR', 'Entered captcha code is incorrect');
  define('_CF_EMAIL', 'Email Address');
  define('_CF_EMAIL_R', 'Please enter your email address');
  define('_CF_PHONE', 'Phone Number');
  define('_CF_SUBJECT', 'Subject');
  define('_CF_DEPARTMENT', 'Department');
  define('_CF_SUBJECT_1', '--- What\'s on your mind? ---');
  define('_CF_SUBJECT_2', 'Compliment');
  define('_CF_SUBJECT_3', 'Criticism');
  define('_CF_SUBJECT_4', 'Suggestion');
  define('_CF_SUBJECT_5', 'Advertise');
  define('_CF_SUBJECT_6', 'Support');
  define('_CF_SUBJECT_7', 'Other');
  define('_CF_EMAIL_ERR', 'Entered email address is invalid!');
  define('_CF_MSG', 'Your Message');
  define('_CF_MSG_R', 'Please enter your message');
  define('_CF_SEND', 'Submit Inquiry');
  define('_CF_SUBJECT1', 'Feedback email from: ');
  define('_CF_ERROR', 'Email could not be sent due to the following error(s):');
  define('_CF_OK', '<span>Thank you!</span>Your message has been sent successfully');
    
  // Admin Backup
  define('_BK_BACKUP_OK', '<span>Success!</span>Backup created successfully!');
  define('_BK_RESTORE_OK', '<span>Success!</span>Database restored successfully!');
  define('_BK_DELETE_OK', '<span>Success!</span>Backup deleted successfully!');
  define('_BK_TITLE1', 'Manage CMS Backups');
  define('_BK_INFO1', 'Make sure your database is backed up frequently. Click on Create backup to manually backup your database.<br />
  The backups are stored in the [<strong>/admin/backups/</strong>] folder and can be downloaded from the list below. <br />
  Your most recent backup is highlighted.');
  define('_BK_CREATE', 'Create Backup');
  define('_BK_SUBTITLE1', 'Viewing Most Recent Backups');
  define('_BK_RESTORE_DB', 'Restore Database');
  define('_BK_RESTORE_BK', 'Restore Backup');
  define('_BK_DELETE_BK', 'Delete Backup');
  
  // Admin Configuration
  define('_CG_UPDATED', '<span>Success!</span>System Configuration updated successfully!');
  define('_CG_ONLYADMIN', '<span>Alert!</span>Sorry you don\'t have administrative privilege to access this page');
  define('_CG_TITLE1', 'System Configuration');
  define('_CG_INFO1', 'Here you can update your system configuration.');
  define('_CG_SUBTITLE1', 'Update System Configuration');
  define('_CG_SITENAME', 'Website Name');
  define('_CG_SITENAME_R', 'Please enter Website Name!');
  define('_CG_SITENAME_T', 'The name of your web site, which is displayed in various locations across your site');
  define('_CG_COMPANY', 'Company Name');
  define('_CG_COMPANY_T', 'This is your website slogan which will appear near your website heading');
  define('_CG_WEBURL', 'Website Url');
  define('_CG_WEBURL_R', 'Please enter Website Url!');
  define('_CG_WEBURL_T', 'Insert full URL WITHOUT any trailing slash  (e.g. http://www.yourdomain.com)');
  define('_CG_WEBEMAIL', 'Website Email');
  define('_CG_WEBEMAIL_R', 'Please enter valid Website Email address!');
  define('_CG_WEBEMAIL_T', 'This is the main email notices will be sent to. It is also used as the from \'email\'<br />when emailing other automatic emails');
  define('_CG_THEME', 'Website Template');
  define('_CG_DEFAULT_TAB', 'Home Page Featured Box');
  define('_CG_LOGO', 'Company Logo');
  define('_CG_LOGO_B', 'Click to Upload');
  define('_CG_LOGO_R', 'Illegal file type. Only jpg,png and gif file types allowed.');
  define('_CG_LOGO_DEL', 'Delete Logo');
  define('_CG_LOGO_T', 'If no logo exists, Company Name will be used instead');
  define('_CG_OFFLINE', 'Put Site Offline');
  define('_CG_OFFLINE_T', 'If site is inactive it will display Maintenance mode message.<br />To access your site go to admin panel and login as admin<br />Now only you\'ll be able to browse your site');
  define('_CG_OFFLINE_MSG', 'Offline Message');
  define('_CG_OFFLINE_MSG_T', 'Enter a message that will be displayed to your visitors,<br />once the site is in offline mode.');
  define('_CG_OFFLINE_TIME', 'Offline Time');
  define('_CG_OFFLINE_TIME_T', 'Select the time when the site should be back online');
  define('_CG_SEO', 'Enable Seo');
  define('_CG_SEO_T', 'If your server supports Apache mod_rewrite, select Yes.');
  define('_CG_PERPAGE', 'Items Per Page');
  define('_CG_PERPAGE_T', 'Default number of items used for pagination');
  define('_CG_SHORTDATE', 'Short Date');
  define('_CG_LONGDATE', 'Long Date');
  define('_CG_DTZ', 'Default Time Zone');
  define('_CG_DTZ_T', 'Select your valid time zone.');
  define('_CG_WEEKSTART', 'Week Starts On.');
  define('_CG_LANG', 'Default Language');
  define('_CG_LANG_SHOW', 'Show Language');
  define('_CG_LANG_SHOW_T', 'If Yes, language switcher will be available to front end users.');
  define('_CG_THUMB_WH', 'Thumb Width/Height');
  define('_CG_THUMB_W_R', 'Please enter Thumbnail Width!');
  define('_CG_THUMB_H_R', 'Please enter Thumbnail Height!');
  define('_CG_THUMB_WH_T', 'Default thumbnail Width/Height, used for resizing images.');
  define('_CG_AVATAR_WH', 'Avatar Width/Height');
define('_CG_facebook_h', 'Facebook height');
define('_CG_twit_count', 'Tweets count');

define('_CG_AVATAR_W_R', 'Please enter Avatar Width!');
  define('_CG_AVATAR_H_R', 'Please enter Avatar Height!');
  define('_CG_AVATAR_WH_T', 'Default avatar Width/Height, used for resizing images.');
  define('_CG_IMG_WH', 'Image Width/Height');
  define('_CG_IMG_W_R', 'Please enter Image Width!');
  define('_CG_IMG_H_R', 'Please enter Image Height!');
  define('_CG_IMG_WH_T', 'Default large image Width/Height, used for resizing images.');
  define('_CG_CURRENCY', 'Default Currency');
  define('_CG_CURRENCY_R', 'Please Enter Valid Currency.');
  define('_CG_CURRENCY_T', 'Enter your currency such as CAD, USD, EUR.');
  define('_CG_CUR_SYMBOL', 'Currency Symbol');
  define('_CG_CUR_SYMBOL_T', 'Enter your currency symbol such as $, &euro;, &pound;.');
  define('_CG_REGVERIFY', 'Registration Verification');
  define('_CG_REGVERIFY_T', 'If Yes users will need to confirm their email address and go through activation process.');
  define('_CG_AUTOVERIFY', 'Auto Registration');
  define('_CG_AUTOVERIFY_T', 'If Yes, once registration process is completed users will be able to login.<br />If No Admin will need to manually activate each account.');
  define('_CG_REGALOWED', 'Allow Registration');
  define('_CG_REGALOWED_T', 'Enable/Disable User Registration.');
  define('_CG_NOTIFY_ADMIN', 'Registration Notification');
  define('_CG_NOTIFY_ADMIN_T', 'Receive notification upon each new user registration.');
  define('_CG_USERLIMIT', 'Enable/Disable User registration');
  define('_CG_USERLIMIT_T', 'Limit number of users that are allowed to register<br /> 0 = Unlimited..');
  define('_CG_LOGIN_ATTEMPT', 'Login attempts');
  define('_CG_LOGIN_ATTEMPT_T', 'Time to wait after the user or admin has failed (x) login attempts.<br /><strong>Default:</strong> 30 Minutes(1800)sec. and 3 Login attempts');
  define('_CG_MAILER', 'Default Mailer');
  define('_CG_LOG_ON', 'Log All Actions');
  define('_CG_LOG_ON_T', 'Whether or not to keep tracks of all user/system actions.<br />Note, that large amount of data will be stored in database.');
  define('_CG_MAILER_T', 'Use PHP Mailer or SMTP protocol for sending emails');
  define('_CG_SMTP_HOST', 'SMTP Hostname');
  define('_CG_SMTP_HOST_R', 'Please Enter Valid SMTP Host!');
  define('_CG_SMTP_HOST_T', 'Specify main SMTP server. E.g.:(mail.yourserver.com)');
  define('_CG_SMTP_USER', 'SMTP Username');
  define('_CG_SMTP_USER_R', 'Please Enter Valid SMTP Username!');
  define('_CG_SMTP_PASS', 'SMTP Password');
  define('_CG_SMTP_PASS_R', 'Please Enter Valid SMTP Password!');
  define('_CG_SMTP_PORT', 'SMTP Port');
  define('_CG_SMTP_PORT_R', 'Please Enter Valid SMTP Port!');
  define('_CG_SMTP_PORT_T', 'Mail server port ( Can be 25, 26. 456 for GMAIL. 587 for Yahoo ). Ask your host if uncertain.');
  define('_CG_GA', 'Google Analytics');
  define('_CG_GA_T', 'Paste your code Google Analytics code here.');
  define('_CG_GA_I', 'To sign up for Google Analytics, visit <a href="http://www.google.com/analytics" target="_blank">Google Analytics</a>');
  define('_CG_METAKEY', 'Site wide Meta Keywords');
  define('_CG_METAKEY_T', 'Meta keywords are used to describe your website.<br />These are used by some search engines to categorise your website.');
  define('_CG_METADESC', 'Site wide Meta Description');
  define('_CG_METADESC_T', 'A meta description is a brief summary of the current page.<br />It may be used by search engines when they display search results containing your website.');
  define('_CG_UPDATE', 'Update Configuration');

  // Admin Email Templates
  define('_ET_TITLE1', 'Manage Email Templates &rsaquo; Edit Template');  
  define('_ET_INFO1', 'Here you can update your email template.'); 
  define('_ET_SUBTITLE1', 'Editing Email Template &rsaquo; '); 
  define('_ET_TTITLE', 'Template Title:'); 
  define('_ET_TTITLE_R', 'Please Enter Template Title!'); 
  define('_ET_SUBJECT', 'Email Subject'); 
  define('_ET_SUBJECT_T', 'Please Enter Email Subject!');
  define('_ET_BODY_R', 'Template Content is required!'); 
  define('_ET_VAR_T', 'Do Not Replace Variables Between [ ]'); 
  define('_ET_UPDATE', 'Update Template');
  define('_ET_TITLE2', 'Manage CMS Email Templates');  
  define('_ET_INFO2', 'Below are your email templates. You can modify content of template(s) to suit your needs.'); 
  define('_ET_SUBTITLE2', 'Viewing Email Templates'); 
  define('_ET_EDIT', 'Edit Template');
  define('_ET_NOTEMPLATE', '<span>Error!</span>Your are missing all email templates. You need to reinstall them manually');
  define('_ET_UPDATED', '<span>Success!</span>Email Template Updated Successfully');
  define('_ET_ADDED', '<span>Success!</span>Email Template Added Successfully');

  // Admin Language Manager
  define('_LA_TITLE1', 'Manage Languages &rsaquo; Edit Language');  
  define('_LA_INFO1', 'Here you can update your CMS language.'); 
  define('_LA_SUBTITLE1', 'Editing CMS Language &rsaquo; ');
  define('_LA_TTITLE', 'Language Name'); 
  define('_LA_TTITLE_R', 'Please Enter Language Name.');
  define('_LA_COUNTRY_ABB', 'Country Abbreviation');
  define('_LA_COUNTRY_ABB_R', 'Please Enter Country Abbreviation');
  define('_LA_COUNTRY_ABB_ERR', 'Country Abbreviation already exist.');
  define('_LA_COUNTRY_ABB_T', 'This is your two letter country abbreviation code.');
  define('_LA_FLAG_ERR', 'Selected language does not exist!');
  define('_LA_UPDATE', 'Update Language');
  define('_LA_TITLE2', 'Manage Languages &rsaquo; Add Language');  
  define('_LA_INFO2', 'Here you can add new CMS Language.'); 
  define('_LA_SUBTITLE2', 'Adding CMS Language');
  define('_LA_ADD_INFO', 'Adding Example: To add <strong>French Language</strong>, enter Language Name->Français, Country Abbreviation->fr, Author->Your Website.<br />Once completed upload your translation into main <strong>/lang/</strong> folder in following format <strong>fr.lang.php</strong>, and country flag as <strong>fr.png</strong><br />
You also need to add translations for every active module. Translations for each modules are stored in <strong>/admin/modules/modulename/lang/.</strong><br />
Here you only need the language file in the same format <strong>fr.lang.php</strong> without a country flag.');
  define('_LA_ADD', 'Add Language');
  define('_LA_ADD_NEW', 'Add New Language');
  define('_LA_TITLE3', 'Manage CMS Languages');  
  define('_LA_INFO3', 'Below are all available languages.<br /><strong>Note: Deleting language will also delete all database tables containing translations for deleted language.<br />Please be patient as this process might take few seconds to complete.</strong>'); 
  define('_LA_SUBTITLE3', 'Viewing CMS Languages'); 
  define('_LA_EDIT', 'Edit Language'); 
  define('_LA_FLAG', 'Country Flag');
  define('_LA_AUTHOR', 'Author');
  define('_LA_NOLANG', '<span>Error!</span>Your are missing all your language entries. You need to reinstall them manually');
  define('_LA_LANG_DELOK', '<span>Success!</span>Language Deleted Successfully');
  define('_LA_LANG_ADDOK', '<span>Success!</span>Language Added Successfully');
  define('_LA_UPDATED', '<span>Success!</span>Language Updated Successfully');
    
  // Admin Newsletter
  define('_NL_TITLE1', 'CMS Newsletter');  
  define('_NL_INFO1', 'Here you can send newsletter to all users subscribed to it.'); 
  define('_NL_SUBTITLE1', 'Sending Newsletter'); 
  define('_NL_RECIPIENTS', 'Recipients');
  define('_NL_ALL', 'All Users');
  define('_NL_REGED', 'Registered Members');
  define('_NL_PAID', 'Paid Members');
  define('_NL_SUBSCRIBED', 'Newsletter Subscribers');
  define('_NL_SUBJECT', 'Newsletter Subject');
  define('_NL_SUBJECT_R', 'Please Enter Newsletter Subject');
  define('_NL_BODY_R', 'Please Enter Email Message!');
  define('_NL_SEND', 'Send Mail');
  define('_NL_SENT_OK', '<span>Success!</span>All Email(s) have been sent successfully!');
  define('_NL_SENT_ERR', '<span>Error!</span>Some of the emails could not be reached!');

  // Admin Gateways
  define('_GW_TITLE1', 'Manage CMS Gateways &rsaquo; Edit Gateway');  
  define('_GW_INFO1', 'Here you can update your gateway settings.'); 
  define('_GW_SUBTITLE1', 'Editing Gateway &rsaquo; '); 
  define('_GW_NAME', 'Gateway Name'); 
  define('_GW_NAME_R', 'Please Enter Display Gateway Name');
  define('_GW_LIVE', 'Set Live Mode');
  define('_GW_LIVE_T', 'When in live mode all transactions will be processed in real time');
  define('_GW_ACTIVE', 'Active');
  define('_GW_ACTIVE_T', 'Only active gateways will be available for payment methods.');
  define('_GW_IPNURL', 'IPN Url');
  define('_GW_UPDATE', 'Update Gateway');
  define('_GW_TITLE2', 'Manage CMS Gateways');  
  define('_GW_INFO2', 'Here you can manage your list of available gateways.'); 
  define('_GW_SUBTITLE2', 'Viewing CMS Gateways');
  define('_GW_EDIT', 'Edit Gateway');
  define('_GW_NOGATEWAY', '<span>Error!</span>Your are missing all gateways. You need to reinstall them manually');
  define('_GW_UPDATED', '<span>Success!</span>Gateway Configuration Updated Successfully');
  
  define('_GW_HELP_PP', '<p><a href="http://www.paypal.com/" title="PayPal" rel="nofollow" target="_blank">Click here to setup an account with Paypal</a> </p>
			<p><strong>Gateway Name</strong> - Enter the name of the payment provider here.</p>
			<p><strong>Active</strong> - Select Yes to make this payment provider active. <br />
			If this box is not checked, the payment provider will not show up in the payment provider list during checkout.</p>
			<p><strong>Set Live Mode</strong> - If you would like to test the payment provider settings, please select No. </p>
			<p><strong>Paypal email address</strong> - Enter your PayPal Business email address here. </p>
			<p><strong>Currency Code</strong> - Enter your currency code here. Valid choices are: </p>
				<ul>
					<li> USD (U.S. Dollar)</li>
					<li> EUR (Euro) </li>
					<li> GBP (Pound Sterling) </li>
					<li> CAD (Canadian Dollar) </li>
					<li> JPY (Yen). </li>
					<li> If omitted, all monetary fields will use default system setting Currency Code. </li>
				</ul>
			<p><strong>Not in Use</strong> - This field it\'s not in use. Leave it empty. </p>
	        <p><strong>IPN Url</strong> - If using recurring payment method, you need to set up and activate the IPN Url in your account: </p>');
  define('_GW_HELP_MB', '<p><a href="http://www.moneybookers.com/" title="http://www.moneybookers.net/" rel="nofollow">Click here to setup an account with MoneyBookers</a></p>
			<p><strong>Gateway Name</strong> - Enter the name of the payment provider here.</p>
			<p><strong>Active</strong> - Select Yes to make this payment provider active. <br />
			If this box is not checked, the payment provider will not show up in the payment provider list during checkout.</p>
			<p><strong>Set Live Mode</strong> - If you would like to test the payment provider settings, please select No. </p>
			<p><strong>MoneyBookers email address</strong> - Enter your MoneyBookers email address here. </p>
			<p><strong>Secret Passphrase</strong> - This field must be set at Moneybookers.com.</p>
	        <p><strong>IPN Url</strong> - If using recurring payment method, you need to set up and activate the IPN Url in your account: </p>');
       
  // Admin File manager
  define('_FM_DELOK', '<span>Success!</span>Directory(s) and file(s) have been deleted');
  define('_FM_DELOK_DIR', '<span>Success!</span>Directory(s) have been deleted');
  define('_FM_DELOK_FILE', '<span>Success!</span>File(s) have been deleted');
  define('_FM_SEL_ERR', '<span>Alert!</span>Please select at least one File/Directory');
  define('_FM_DEL_ERR', '<span>Error!</span>There was an Error Deleting File(s) and Directory(s)');
  define('_FM_DEL_ERR2', '<span>Error!</span>Invalid File or Directory Selected');
  define('_FM_FILENAME_R', '<span>Error!</span>Please enter valid filename.');
  define('_FM_FILENAME_T', 'Enter your new file name.');
  define('_FM_FILENAME1', '<span>Success!</span>File');
  define('_FM_FILENAME2', 'was created.');
  define('_FM_FILENAME_ERR', '<span>Error!</span>There was an Error creating File');
  define('_FM_DIRPER_OK', '<span>Success!</span>Permissions were successfully changed');
  define('_FM_DIRPER_ERR', '<span>Error!</span>There was an error updating permissions for');
  define('_FM_DIR_NAME_R', '<span>Error!</span>Please enter directory name');
  define('_FM_DIR_NAME_T', 'Enter your new directory name.');
  define('_FM_DIR_OK1', '<span>Success!</span>Directory');
  define('_FM_DIR_OK2', 'was created.');
  define('_FM_DIR_ERR', '<span>Error!</span>There was an Error creating directory ');
  define('_FM_DIR_DEL_OK1', '<span>Success!</span>Directory');
  define('_FM_DIR_DEL_OK2', 'was fully deleted');
  define('_FM_DIR_DEL_ERR', '<span>Error!</span>There was an Error Deleting Directory');
  define('_FM_PER_OK1', '<span>Success!</span>Permissions for');
  define('_FM_PER_OK2', 'were changed.');
  define('_FM_PER_ERR', '<span>Error!</span>There was an error changing permissions for');
  define('_FM_PER_OCT_ERR', '<span>Error!</span>Please enter valid value.');
  define('_FM_FILE_OK1', '<span>Success!</span>File');
  define('_FM_FILE_OK2', 'was deleted');
  define('_FM_FILE_ERR', '<span>Error!</span>There was an Error Deleting File');
  define('_FM_NO_DIR1', '<div class="msgError"><span>Error!</span>"');
  define('_FM_NO_DIR2', 'is not a directory !!!</div>');
  define('_FM_ACCESS1', '<div class="msgError"><span>Error!</span>');
  define('_FM_ACCESS2', 'Access denied . <br>You do not have enough rights to view the dir</div>');
  define('_FM_DELFILE_D', 'Delete File/Directory');
  define('_FM_DELFILE_DM', 'This item will be permanently deleted and cannot be recovered. Are you sure?');
  define('_FM_DELDIR_D', 'Delete Directory');
  define('_FM_DELDIR_DM', 'This will be permanently delete directory and all files inside. Are you sure?');
  define('_FM_DELMUL_D', 'Delete Multiple Files/Directories');
  define('_FM_DELMUL_DM', 'Do you want to delete this file(s) or folder(s) !');
  define('_FM_CHMOD_D', 'CHMOD File/Directory');
  define('_FM_CHMOD_DM', 'Please enter the new permissions<br />[ x = 1 , w = 2 , r = 4 ] <br />The value should be octal( 0666 , 0755 etc )');
  define('_CHMOD_I', 'CHMOD Item');
  define('_CHMOD_M', 'CHMOD Multiple');
  define('_FM_TITLE', 'File Manager');
  define('_FM_CURDIR', 'Current Directory');
  define('_FM_MFILEUPL', 'Multiple File Uploads');
  define('_FM_VIEW_ALL', 'Viewing All Files');
  define('_FM_SIZE', 'Size');
  define('_FM_PERM', 'Permission');
  define('_FM_NAME', 'Name');
  define('_FM_PATH', 'Path');
  define('_FM_CREATE', 'Create');
  define('_FM_SEL_ALL', 'Select or deselect all files');
  define('_FM_DIRS', 'Directories');
  define('_FM_FILES', 'Files');
  define('_FM_FILE', 'File');
  define('_FM_DELFILE', 'Delete File');
  define('_FM_VIEWFILE', 'View File');
  define('_FM_NEWFILE', 'New File');
  define('_FM_CHGPER', 'Change Permissions');
  define('_FM_EDITFILE', 'Edit File');
  define('_FM_NEWDIR', 'New Directory');
  define('_FM_FILESAVEOK1', '<span>Success!</span>');
  define('_FM_FILESAVEOK2', 'was saved successfully');
  define('_FM_FILESAVEERR1', '<span>Error!</span>');
  define('_FM_FILESAVEERR2', 'Error saving !!!');
  define('_FM_EDITING', 'Editing');
  define('_FM_UPLOAD', 'Upload');
  define('_FM_FILSIZE', 'File size');
  define('_FM_FILEOWNER', 'Owner');
  define('_FM_FILELM', 'Last modified');
  define('_FM_FILEGROUP', 'Group');
  define('_FM_FILLA', 'Last accessed');
  define('_FM_UPLOAD_ERR1', 'Error: The upload directory doesn\'t exist!');
  define('_FM_UPLOAD_ERR2', 'Error: The upload directory is NOT writable!');
  define('_FM_UPLOAD_ERR3', 'Not selected');
  define('_FM_UPLOAD_ERR4', 'Wrong file extension');
  define('_FM_UPLOAD_ERR5', 'Failed to upload. File must be ');
  define('_FM_UPLOAD_ERR6', 'already exists.');
  define('_FM_UPLOAD_ERR7', 'uploaded successfully.');
  define('_FM_UPLOAD_ERR8', 'Failed to upload');
  define('_FM_UPLOAD_ERR9', '<span>Error!</span>Please select file to upload');
  define('_FM_VIEWING', 'Viewing');
  define('_FM_FILE_SEL', 'Choose a File');
  
  // Admin Get Remote Links
  define('_RL_SELECT', '--- Select Content Page ---');
  
  // Admin Layout
  define('_LY_TITLE', 'Manage CMS Layout');
  define('_LY_INFO', 'Here you can manage your cms layout.<br />First select the page form dropdown list for which you want to manage layout');
  define('_LY_SEL_PAGE', '--- Select Page ---');
  define('_LY_SEL_MODULE', '--- Select Module ---');
  define('_LY_VIEW_FOR', 'Viewing Content Layout For');
  define('_LY_NOMODS', '<span>Info!</span>No modules available');
  
  // Admin Login
  define('_LG_INFO', 'Enter your username/password to login.');
  define('_LG_BACK', 'Back to Front');
  
  define('_LG_ERROR1', 'Please enter valid username and password.');
  define('_LG_ERROR2', 'Login and/or password did not match to the database.');
  define('_LG_ERROR3', 'Your account has been banned.');
  define('_LG_ERROR4', 'Your account it\'s not activated.');
  define('_LG_ERROR5', 'You need to verify your email address.');
  define('_LG_BRUTE_RERR', 'Too many login attempts. Please wait <strong>%MINUTES%</strong> minutes before next login attempt.');
  
  // Admin Main
  define('_MN_TITLE', 'Welcome to admin panel');
  define('_MN_INFO', 'This is the control panel, From here you can manage your website without any technical knowledge of html or php, All you need to know is just how to work on a simple notepad with the keyboard on a computer.');
  define('_MN_SUBTITLE', 'Latest Statistics');
  define('_MN_INFO2', 'Here you can view your latest visitor statistics.');
  define('_MN_M_STATS', 'Monthly Stats');
  define('_MN_M_STATS_FOR', 'Monthly Statistics For');
  define('_MN_EMPTY_STATS', 'Empty Stats Table');
  define('_MN_NOSTATS', '<span>Alert!</span>There are no statistics for selected Month/Year...');
  define('_MN_TOTAL_V', 'Total Visits');
  define('_MN_TOTAL_H', 'Total Hits');
  define('_MN_UNIQUE_V', 'Unique Visits');
  define('_MN_STATS_EMPTY', '<span>Success!</span>Statistics table is empty!');
  	  
  // Admin Menus
  define('_MU_TITLE1', 'Manage CMS Menus &rsaquo; Edit Menu');  
  define('_MU_INFO1', 'Here you can update your menu items.'); 
  define('_MU_SUBTITLE1', 'Edit Content Menu &rsaquo; '); 
  define('_MU_NAME', 'Menu Name'); 
  define('_MU_NAME_R', 'Please Enter Menu Name'); 
  define('_MU_NAME_T', 'The name of the menu will appear in navigation');
  define('_MU_MENUS', 'Menus'); 
  define('_MU_PARENT', 'Menu Parent'); 
  define('_MU_TOP', 'Top Level'); 
  define('_MU_TOP_T', 'Choose from dropdown, or leave &quot;Top Level&quot; if this is Top-level menu.'); 
  define('_MU_TYPE', 'Item Type');
  define('_MU_TYPE_R', 'Please Select Content Type');
define('_PostDate_TYPE_R', 'Please Select Post Date');
  define('_MU_TYPE_SEL', '--- Select Content Type ---');
  define('_MU_TYPE_SEL_T', 'This menu will link to Following:<br />-Content Page<br />-External Link<br />-File Upload.');
  define('_MU_LINK', 'Select Page');
  define('_MU_LINK_T', 'Enter full url starting with http://');
  define('_MU_TARGET', '--- Target ---');
  //define('_MU_TARGET_S', 'Same Window');
  //define('_MU_TARGET_B', 'New Window');
  define('_MU_TARGET_S', '_self');
  define('_MU_TARGET_B', '_blank');
  define('_MU_ICON', 'Menu Icon');
  define('_MU_NOICON', '--- No Icon Required ---');
  define('_MU_PUB', 'Menu Published');
  define('_MU_HOME', 'Home Page');
  define('_MU_HOME_T', 'If Yes it will be default homepage menu');
  define('_MU_UPDATE', 'Update Menu');
  define('_MU_TITLE2', 'Manage CMS Menus');
  define('_MU_INFO2', 'Use the form below to create a new menu (such as a navigation menu of web pages) which can then be displayed on your web site.<br />
  Drag and drop items to change their positions on the tree.<br />Click on a menu or submenu name to access edit options. Click on <img src="images/delete.png" alt="" title="Delete" width="12"/> to delete. Click on <img src="images/save.png" alt="" title="Save" width="12"/> to save menu positions.<br />
  <strong>Note: Deleting parent menu will also delete all children assigned under the same parent.</strong>');
  define('_MU_SUBTITLE2', 'Adding New Menu');
  define('_MU_NONE', '--- none ---');
  define('_MU_ADD', 'Add Menu');
  define('_MU_SAVE', 'Save Menu Position');
  define('_MU_UPDATED', '<span>Success!</span>Menu updated successfully!');
  define('_MU_ADDED', '<span>Success!</span>Menu added successfully!');
  define('_MU_SORTED', '<span>Success!</span>Menus sorted successfully!');
  define('_MU_CANT_MOVE', 'Can not move menu. System menus can not be moved.');

  // Admin Plugins
  define('_PL_TITLE1', 'Manage CMS Pages &rsaquo; Edit Plugin');  
  define('_PL_INFO1', 'Here you can update your content plugin.'); 
  define('_PL_SUBTITLE1', 'Edit Content Plugin &rsaquo; ');
  define('_PL_TITLE', 'Plugin Title');
  define('_PL_TITLE_R', 'Please Enter Plugin Title');
  define('_PL_PUB', 'Plugin Published');
  define('_PL_SHOW_TITLE', 'Show Title');
  define('_PL_ALT_CLASS', 'Additional Class');
  define('_PL_ALT_CLASS_T', 'You can assign additional css classes for plugin styling.');
  define('_PL_BODY', 'Plugin Body');
  define('_PL_DESC', 'Plugin Description');
  define('_PL_UPDATE', 'Update Plugin');
  define('_PL_TITLE2', 'Manage CMS Plugins &rsaquo; Add Plugin');
  define('_PL_INFO2', 'Here you can add new content plugin.');
  define('_PL_SUBTITLE2', 'Add Content Plugin');
  define('_PL_ADD', 'Add New Plugin');
  define('_PL_TITLE3', 'Manage CMS Plugins');
  define('_PL_INFO3', 'Here you can manage your content plugin.');
  define('_PL_SUBTITLE3', 'Viewing Content Plugins');
  define('_PL_CREATED', 'Plugin Created');
  define('_PL_PUB2', 'Published');
  define('_PL_EDIT', 'Edit Plugin');
  define('_PL_CONFIG', 'Configure');
  define('_PL_SYS', 'System Plugin');
  define('_PL_NOPLUG', '<span>Alert!</span>You don\'t have any plugin yet...');
  define('_PL_UPDATED', '<span>Success!</span>Plugin updated successfully!');
  define('_PL_ADDED', '<span>Success!</span>Plugin added successfully!');
    
  // Admin Modules
  define('_MO_TITLE1', 'Manage CMS Pages &rsaquo; Edit Module');  
  define('_MO_INFO1', 'Here you can update your content module.'); 
  define('_MO_SUBTITLE1', 'Edit Content Module &rsaquo; ');
  define('_MO_TITLE', 'Module Title');
  define('_MO_TITLE_R', 'Please Enter Module Title');
  define('_MO_PUB', 'Module Published');
  define('_MO_SHOW_TITLE', 'Show Title');
  define('_MO_ALT_CLASS', 'Aditional Class');
  define('_MO_ALT_CLASS_T', 'You can assign additional css classes for module styling.');
  define('_MO_BODY', 'Module Body');
  define('_MO_DESC', 'Module Description');
  define('_MO_THEME', 'Default Theme');
  define('_MO_THEME_DEFAULT', '--- Default System Template ---');
  define('_MO_UPDATE', 'Update Module');
  define('_MO_TITLE2', 'Manage CMS Module &rsaquo; Add Module');
  define('_MO_INFO2', 'Here you can add new content module.');
  define('_MO_SUBTITLE2', 'Add Content Module');
  define('_MO_ADD', 'Add New Module');
  define('_MO_TITLE3', 'Manage CMS Module');
  define('_MO_INFO3', 'Here you can manage your content modules.');
  define('_MO_SUBTITLE3', 'Viewing Content Modules');
  define('_MO_CREATED', 'Module Created');
  define('_MO_PUB2', 'Published');
  define('_MO_EDIT', 'Edit Module');
  define('_MO_CONFIG', 'Configure');
  define('_MO_SYS', 'System Module');
  define('_MO_NOMOD', '<span>Alert!</span>You don\'t have any module yet...');
  define('_MO_UPDATED', '<span>Success!</span>Module updated successfully!');
  define('_MO_ADDED', '<span>Success!</span>Module added successfully!');

  // Admin Memberships
  define('_MS_TITLE1', 'Manage CMS Memberships &rsaquo; Edit Membership');
  define('_MS_INFO1', 'Here you can update your membership package.');
  define('_MS_SUBTITLE1', 'Editing Membership &rsaquo; ');
  define('_MS_TITLE', 'Membership Title');
  define('_MS_TITLE_R', 'Please enter Membership Title!');
  define('_MS_PRICE', 'Membership Price');
  define('_MS_PRICE_R', 'Please enter valid Price!');
  define('_MS_PRICE_T', 'Enter price in 0.00 format');
  define('_MS_PERIOD', 'Membership Period');
  define('_MS_PERIOD_R', 'Please Enter membership period!');
  define('_MS_PERIOD_R2', 'Period must be numeric value!');
  define('_MS_PERIOD_T', 'Period before membership expires.<br />Valid values are:<br />
  	  Day(s) Allowable range is 1 to 90<br />
  	  Week(s) Allowable range is 1 to 52<br />
      Month(s) Allowable range is 1 to 24<br />
      Year(s) Allowable range is 1 to 5');
  define('_MS_TRIAL', 'Trial Membership');
  define('_MS_TRIAL_T', 'Trial Membership will be available for one time use only.<br /> You can only have one trial membership in total.');
  define('_MS_RECURRING', 'Recurring Payment');
  define('_MS_RECURRING_T', 'If Yes system will create recurring subscription.');
  define('_MS_PRIVATE', 'Private Membership');
  define('_MS_PRIVATE_T', 'Private memberships are not available to front end users.');
  define('_MS_ACTIVE', 'Active Membership');
  define('_MS_ACTIVE_T', 'Only active memberships will be available for purchase.');
  define('_MS_DESC', 'Membership Description');
  define('_MS_UPDATE', 'Update Membership');
  define('_MS_TITLE2', 'Manage CMS Memberships &rsaquo; Add Membership');
  define('_MS_INFO2', 'Here you can add new membership type.');
  define('_MS_SUBTITLE2', 'Add Membership Type');
  define('_MS_ADD', 'Add Membership');
  define('_MS_ADD_NEW', 'Add New Membership');
  define('_MS_TITLE3', 'Manage CMS Memberships');
  define('_MS_INFO3', 'Here you can manage your membership packages.<br /><strong>Note: Make sure you are not deleting or deactivating memberships assigned to active users.</strong>');
  define('_MS_SUBTITLE3', 'Viewing Membership Packages');
  define('_MS_EDIT', 'Edit Membership');
  define('_MS_TITLE4', 'Title');
  define('_MS_PRICE2', 'Price');
  define('_MS_EXPIRY', 'Expiry');
  define('_MS_DAYS2', ' days');
  define('_MS_DESC2', 'Description');
  define('_MS_ACTIVE2', 'Active');
  define('_MS_NOMBS', '<span>Alert!</span>You don\'t have any membership packages yet...');
  define('_MS_UPDATED', '<span>Success!</span>Membership updated successfully!');
  define('_MS_ADDED', '<span>Success!</span>Membership added successfully!');
  define('_MS_TRIAL_USED', '<span>Info!</span>Sorry, you have already used your trial membership!');
  define('_MS_MEM_ACTIVE_OK', '<span>Success!</span>You have successfully activated ');
  define('_MS_MEM_ACTIVE_ERR', '<span>Error!</span>Sorry there was an error activating your membership. Please contact the administrator!');


  // Admin Transactions
  define('_TR_TITLE1', 'Manage CMS Membership Transactions');
  define('_TR_INFO1', 'Here you can view all your payment transactions.');
  define('_TR_SUBTITLE1', 'Viewing Transactions');
  define('_TR_FINDPAY', 'Payment Amount...');
  define('_TR_SHOW_FROM', 'From');
  define('_TR_SHOW_TO', 'To');
  define('_TR_FIND', 'Find');
  define('_TR_EXPORTXLS', 'Export To Excel Format');
  define('_TR_VIEW_REPORT', 'View Sales Report');
  define('_TR_PAY_FILTER', 'Payment Filter');
  define('_TR_RESET_FILTER', '-- Reset Payment Filter -');
  define('_TR_MEMNAME', 'Membership Name');
  define('_TR_USERNAME', 'Username');
  define('_TR_AMOUNT', 'Amount');
  define('_TR_PAYDATE', 'Payment Date');
  define('_TR_PROCESSOR', 'Processor');
  define('_TR_STATUS', 'Status');
  define('_TR_NOTRANS', '<span>Alert!</span>You don\'t have any transactions yet...');
  define('_TR_TITLE2', 'Viewing CMS Membership Sales');
  define('_TR_INFO2', 'Here you can view your sales report.');
  define('_TR_SUBTITLE2', 'Viewing Sales Report');
  define('_TR_SALES3', 'Sales Statistics For');
  define('_TR_MONTHSALES3', 'Monthly Sales Statistics For ');
  define('_TR_MONTHVIEW', 'Switch To Monthly View');
  define('_TR_YEARVIEW', 'Switch To Yearly View');
  define('_TR_MONTHSTATS', 'Monthly Statistics');
  define('_TR_SALEITEMS', ' item(s)');
  define('_TR_TOTSALES', 'Total Sales');
  define('_TR_TOTREV', 'Total Revenue');
  define('_TR_AVERAGE', 'Average Sale');
  define('_TR_MONTHYEAR', 'Month / Year');
  define('_TR_TOTALYEAR', 'Total Year');
  define('_TR_NOYEARSALES', '<span>Alert!</span>There are no sales for selected Year...');
  define('_TR_NOMONTHSALES', '<span>Alert!</span>There are no sales for selected Month/Year...');
    
  // Admin Pages
  define('_PG_TITLE1', 'Manage CMS Pages &rsaquo; Edit Page');

define('_PG_TITLEview', 'Manage CMS Pages &rsaquo; View Page');
  define('_PG_INFO1', 'Here you can update your content page.');
define('_PG_INFO1view', 'Here you can view your content page.');
  define('_PG_SUBTITLE1', 'Edit Content Page &rsaquo; ');
define('_PG_SUBTITLE1Page', 'View Content Page &rsaquo; ');

define('_PG_TITLE', 'Page Title');
  define('_PG_SECTION', 'Section');
  define('_PG_TITLE_R', 'Please Enter Page Title');
  define('_PG_SLUG', 'Page Slug');
  define('_PG_SLUG_T', 'Title appearing in browser navigation bar.<br />If left empty will use Page Title instead.');
  define('_PG_NO_POSTS', 'There are no posts under this page!');
  define('_PG_YES_POSTS', 'Posts Under This Page');
  define('_PG_PUB', 'Page Published');
  define('_PG_CC', 'Attach Contact Form');
  define('_PG_CC_T', 'This option allows you to add a contact form to your content item.<br/>The contact form will be placed after your content.');
  define('_PG_GAL', 'Attach Gallery');
  define('_PG_COMMENTS', 'Allow Comments');
  define('_PG_COMMENTS_T', 'If Yes Comments will be available for this page.<br/>The comments will be placed after your content.');
  define('_PG_MEMBERSHIP_R', 'Please Select At Least One Membership Type.');
  define('_PG_GAL_SEL', '--- Select Gallery ---');
  
  define('_PG_ACCESS_L', 'Access Level');
  define('_PG_MEM_LEVEL', 'Membership Level');
  define('_PG_NOMEM_REQ', '-- No Membership Required --');
  define('_PG_MEM_LEVEL_T', 'Click and hold to select Multiple Memberships');
  define('_PG_SEL_MODULE', 'Module Assignment');
  
  define('_PG_KEYS', 'Page Keywords');
  define('_PG_KEYS_T', 'Enter meta keywords separated by coma.');
  define('_PG_DESC', 'Page Description');
  define('_PG_UPDATE', 'Update Page');
  define('_PG_TITLE2', 'Manage CMS Pages &rsaquo; Add Page');
  define('_PG_INFO2', 'Here you can add new content page');
  define('_PG_SUBTITLE2', 'Add Content Page');
  define('_PG_ADD', 'Add New Page');
  define('_PG_TITLE3', 'Manage CMS Pages');
  define('_PG_INFO3', 'Here you can manage your content pages.<br />');
  define('_PG_SUBTITLE3', 'Viewing Content Pages');
  
  define('_PG_HOME', 'Home Page');
  define('_PG_ISCC', 'Contact Form');
  define('_PG_EDIT', 'Edit Page');
  define('_PG_VIEW', 'View Page');
  define('_PG_VIEW2', 'View');
  define('_PG_EDIT2', 'Edit');
  define('_PG_DELETE', 'Delete');
  define('_PG_VIEW_P', 'View Posts');
  define('_PG_NEW_P', 'New Post');
  define('_PG_NOPAGES', '<span>Alert!</span>You don\'t have any pages yet...');
  define('_PG_ISCCPAGE', 'Contact Page');
  define('_PG_UPDATED', '<span>Success!</span>Content Page updated successfully!');
  define('_PG_ADDED', '<span>Success!</span>Content Page added successfully!');
  define('_PG_COPIED', '<span>Success!</span>Content Page copied successfully!');
  define('_LAST_MOD', 'Last Modified');
  define('_MOD_BY', 'Modified By');

  // Admin Posts
  define('_PO_TITLE1', 'Manage CMS Posts &rsaquo; Edit Post');
  define('_PO_INFO1', 'Here you can update your content post.');
  define('_PO_SUBTITLE1', 'Edit Content Post &rsaquo; ');
  define('_PO_TITLE', 'Post Title');
  define('_PO_TITLE_R', 'Please Enter Post Title');
  define('_PO_PARENT', 'Parent Page');
  define('_PO_PUB', 'Post Published');
  define('_PO_SHOW_T', 'Show Title');
  define('_PO_BODY', 'Post Body');
  define('_PO_JSCODE', 'Javascript Code');
  define('_PO_JSCODE_T', 'Add additional javascript code including javascript tags');
  define('_PO_UPDATE', 'Update Post');
  define('_PO_TITLE2', 'Manage CMS Posts &rsaquo; Add Post');
  define('_PO_INFO2', 'Here you can add new content post');
  define('_PO_SUBTITLE2', 'Add Content Post');
  define('_PO_ADD', 'Add New Post');
  define('_PO_TITLE3', 'Manage CMS Posts');
  define('_POINFO3', 'Here you can manage your content posts');
  define('_PO_SUBTITLE3', 'Viewing Content Posts');
  define('_PO_PAGE_TITLE', 'Page Title');
  define('_PO_EDIT', 'Edit Post');
  define('_PO_NOPOST', '<span>Alert!</span>You don\'t have any posts under this page yet...');
  define('_PO_UPDATED', '<span>Success!</span>Content Post updated successfully!');
  define('_PO_ADDED', '<span>Success!</span>Content Post added successfully!');
  
  // Admin Users
  define('_UR_TITLE1', 'Manage CMS Pages &rsaquo; Edit User');
  define('_UR_TITLE22', 'Manage CMS Users &rsaquo; View User');
  define('_UR_TITLE11', 'Manage CMS Pages &rsaquo; Edit Group');
  define('_UR_INFO1', 'Here you can update your event item info.');
  define('_UR_INFO22', 'This is the user\'s info.');
  define('_ACTIVE', 'Active');
  define('_INACTIVE', 'Inactive');
  define('_UR_SUBTITLE1', 'Edit Current User &rsaquo; ');
  define('_UR_SUBTITLE22', 'View Current User &rsaquo; ');
  define('_UR_PERMISSION1', 'Should the user have his own permissions?');
  define('_UR_PERMISSION2', 'The user has his own permissions?');
  define('_UR_PASS_T', 'Leave it empty unless changing the password');
  define('_UR_EMAIL', 'Email Address');
  define('_UR_USERNAME', 'Username');
  define('_UR_NOUSERS', 'There are no users in this department.');
  define('_UR_EMAIL_R', 'Please Enter Valid Email Address');
  define('_UR_EMAIL_R1', 'Entered Email Address Is Already In Use.');
  define('_UR_EMAIL_R2', 'Entered Email Address Is Not Valid.');
  define('_UR_EMAIL_R3', 'Entered Email Address Does Not Exists.');
  define('_UR_FNAME', 'First Name');
  define('_UR_FNAME_R', 'Please Enter First Name');
  define('_UR_LNAME', 'Last Name');
  define('_ADDRESS', 'Address');
  define('_CITY', 'City');
  define('_STATE', 'State');
  define('_ZIPCODE', 'Zipcode');
  define('_PHONE', 'Phone');
  define('_MOBILE', 'Mobile');
  define('_FAX', 'Fax');
  define('_UR_LNAME_R', 'Please Enter Last Name');
  define('_UR_NAME', 'Name');
  define('_UR_NOMEMBERSHIP', '--- No Membership Required---');
  define('_UR_NODEPARTMENT', '--- No DEPARTMENT---');
  define('_UR_LEVEL', 'User Level');
  define('_UR_DEPARTMENT', 'User Department');
  define('_UR_PERM', 'User Permissions');
  define('_UR_PERM1', 'Manage Menu Items');
  define('_UR_PERM_T', 'Select which components administrator will be able to access.<br/> Only applies to Regular Administrators. Super Admin will have full access.<br />Hold Ctrl/Command for multiple selections.');
    define('_UR_PERM_T1', 'Select which Menu Items this department will have access to.<br />After selecting the item you will chosse permissions for this item..');
  define('_UR_AVATAR', 'User Avatar');
  define('_UR_STATUS', 'User Status');
  define('_UR_STATUS1', 'Department / Group Status');
  define('_UR_OWN_CONTACT', 'Department users can view emails sent using contact form to this department<br>If not, they will only be sent the email provided for this department.');
  define('_UR_ALL_CONTACT', 'Department users can view emails sent using contact form to ALL departments.');
  define('_UR_EDIT_EMAIL_TEMPLATES', 'Department users can view/edit/delete email templates.');
  define('_UR_EDIT_AUTO_RESPONSE', 'Department users can view/edit/delete auto-response templates.');
    define('_UR_EDIT_AUTO_EVENTS', 'Users can manage all events (edit/remove/add) under selected menu items.');
    define('_UR_EDIT_AUTO_GALLERIES', 'Users can manage all galleries (edit/remove/add) under selected menu items.');
define('_UR_OWN_CONTACT_TITLE', 'Access Department Contacts');
  define('_UR_ALL_CONTACT_TITLE', 'Access ALL Department Contacts');
  define('_UR_EDIT_EMAIL_TEMPLATES_TITLE', 'Access email templates');
  define('_UR_EDIT_AUTO_RESPONSE_TITLE', 'Access auto-response templates');    //
  define('_UR_EDIT_AUTO_EVENTS_TITLE', 'Manage Events');
  define('_UR_EDIT_AUTO_GALLERIES_TITLE', 'Manage Galleries');
  define('_UR_EDIT_AUTO_PAGES_TITLE', 'Manage Pages');
  define('_UR_VIEW_AUTO_PAGES_TITLE', 'User can manage pages');
  define('_UR_VIEW_AUTO_GALLERIES_TITLE', 'User can manage galleries');
  define('_UR_VIEW_AUTO_EVENTS_TITLE', 'User can manage events');
  define('_UR_SADMIN', 'Super Admin');
  define('_UR_ADMIN', 'Admin');
  define('_UR_ADMIN_T', 'Super Admin has full rights.<br />Admin has assignable permissions.<br />User it\'s just registered user.');
  define('_UR_ACTIVE', 'User Active');
  define('_UR_IS_NEWSLETTER', 'Newsletter Subscriber');
  define('_UR_NOTIFY', 'Notify User');
  define('_UR_NOTIFY_T', 'Send welcome email to this user.');
  define('_UR_LASTLOGIN', 'Last Login');
  define('_UR_LASTLOGIN_IP', 'Last Login IP');
  define('_UR_DATE_REGGED', 'Date Registered');
  define('_UR_DATE_CREATED', 'Date Created');
  define('_UR_UPDATE', 'Update User');
  define('_UR_UPDATE1', 'Update Department');
  define('_UR_TITLE2', 'Manage CMS Users &rsaquo; Add User');
  define('_UR_TITLE21', 'Manage CMS Departments / Groups &rsaquo; Add Department / Group');
  define('_UR_INFO2', 'Here you can add new user');
  define('_UR_INFO21', 'Here you can add new department / group');
  define('_UR_SUBTITLE2', 'Adding New User');
  define('_UR_SUBTITLE21', 'Adding New Department / Group');
  define('_UR_USERAVAIL', 'Username Available');
  define('_UR_USERNOAVAIL', 'Username Not Available');
  define('_UR_USERNAME_R', 'Please Enter Valid Username');
  define('_UR_GROUPNAME_R', 'Please Enter Valid Department Name');
  define('_UR_USERNAME_R0', 'We are sorry, selected username does not exist in our database');
  define('_UR_USERNAME_R1', 'Username Is Too Short (less Than 4 Characters Long).');
  define('_UR_GROUPNAME_R1', 'Department name Is Too Short (less Than 4 Characters Long).');
  define('_UR_USERNAME_R2', 'Invalid Characters Found In Username.');
  define('_UR_GROUPNAME_R2', 'Invalid Characters Found In department Name.');
  define('_UR_USERNAME_R3', 'Sorry, This Username Is Already Taken');
  define('_UR_GROUPNAME_R3', 'Sorry, This department name Is Already Taken');
  define('_UR_PASSWORD_R', 'Please Enter Valid Password.');
  define('_UR_PASSWORD_R1', 'Password is too short (less than 6 characters long)');
  define('_UR_PASSWORD_R2', 'Password entered is not alphanumeric.');
  define('_UR_PASSWORD_R3', 'Your password did not match the confirmed password!.');
  define('_UR_ADD', 'Add New User');
  define('_UR_ADD1', 'Add New Department / Group');
  define('_UR_TITLE3', 'Manage CMS Users');
  define('_UR_TITLE31', 'Manage CMS Departments / Groups');
  define('_UR_INFO3', 'Here you can manage your users. <br />You can email each user by clicking on email.');
  define('_UR_INFO31', 'Here you can manage CMS departments.');
  define('_UR_INFO32', 'These are the users in the department.');
  define('_UR_SUBTITLE3', 'Viewing Users');
  define('_UR_SUBTITLE31', 'Viewing Derartment / Groups');
  define('_UR_FIND_UNAME', 'Search Username');
  define('_UR_FIND_UNAME1', 'Search Department');
  define('_UR_USR_FILTER', 'User Filter');
  define('_UR_SORT', 'Order By');
  define('_UR_USR_FILTER1', 'Department Filter');
  define('_UR_RESET_FILTER', '--- Reset User Filter ---');
  define('_UR_RESET_FILTER1', '--- Reset Department Filter ---');
  define('_UR_SHOW_FROM', 'From');
  define('_UR_SHOW_TO', 'To');
  define('_UR_FIND', 'Go');
  define('_UR_EDIT', 'Edit User');
  define('_UR_EDIT1', 'Edit');
  define('_UR_VIEW1', 'View users');
  define('_UR_VIEWEDITDELETEGROUP', '');
  define('_UR_NOUSER', '<span>Alert!</span>You don\'t have any users  yet...');
  define('_UR_NOGROUP', '<span>Alert!</span>You don\'t have any departments / groups  yet...');
  define('_UR_UPDATED', '<span>Success!</span>User updated successfully!');
  define('_UR_UPDATED1', '<span>Success!</span>Group updated successfully!');
  define('_UR_ADDED', '<span>Success!</span>User added successfully!');
  define('_UR_ADDED1', '<span>Success!</span>Group added successfully!');
  define('_UR_ADMIN_E', '<span>Error!</span>You cannot delete main Super Admin account!');

  // Pagination
  define('_PAG_PREV', 'Prev');
  define('_PAG_NEXT', 'Next');
  define('_PAG_GOTO', 'Go to page');
  define('_PAG_OF', 'of');
  define('_PAG_IPP', 'Display per page');
    
  // Admin Help Layout
  define('_HP_LAYOUT_TITLE', 'Managing Layout');
  define('_HP_LAYOUT_BODY', 'Layout allows you to dynamically assign plugins to each page/module.<br />
    Each page can have up to four different plugins placements. Top, Bottom ,Left and Right.<br />
    Drag and drop available plugins from the left onto layout placeholder.<br />
    You can also reorder plugin position by dragging plugins up and down.<br />
    To remove the plugin from placeholder drag it back to the left.<br />
    <p class="info">Choose page from the dropdown menu to assign plugins to it. <br />
      By default home page is selected automatically.<br />If any of the multipage Premium Modules are installed, additional dropdown menu will appear. </p>');
  
  // Admin Help Pages
  define('_HP_PAGES_TITLE', 'Managing Pages');
  define('_HP_PAGES_BODY', '<ul>
    <li><span>Page Title:</span>This is the title that will appear in browser title bar.</li>
    <li><span>Page Published:</span>Only published pages will be visible.</li>
    <li><span>Home Page:</span>If selected this page will be default home page.</li>
    <li><span>Contact Form:</span>If yes this page will serve as contact page.</li>
    <li><span>Attach Gallery:</span>If selected this page will have it\'s own dedicated gallery.</li>
	<li><span>Access Level:</span>Options; Public, Registered Membership.
	<ul>
	<li><span>Public:</span> - All your visitors will have access to this page.</li>
	<li><span>Registered:</span> - Only registered and logged in users will have an access to this page.</li>
	<li><span>Membership:</span> - Only users with valid membership(must be logged in) will have an access to this page.</li>
	</ul>
	</li>
	<li><span>Allow Comments:</span>If Yes comments will be available under this page.</li>
    <li><span>Page Keywords:</span>Meta Keywords used for SEO optimization.</li>
    <li><span>Page Description:</span>Meta Description used for SEO optimization.</li>
  </ul>');
  define('_HP_PAGES_TIP', 'Drag <img src="images/handle.png" alt=""/> to rearrange post order.');
  
  // Admin Help Posts
  define('_HP_POSTS_TITLE', 'Managing Posts');
  define('_HP_POSTS_BODY', '<ul>
    <li><span>Post Title:</span>This is the title that will appear in your post.</li>
    <li><span>Parent Page:</span>Select page from dropdown list to assign your post to it.</li>
    <li><span>Post Published:</span>Only published posts will be visible.</li>
    <li><span>Show Title:</span>Choose to show post title.</li>
    <li><span>Post Body:</span>Enter your post content here.</li>
  </ul>');
  define('_HP_POSTS_TIP', 'Don\'t forget you can assign more than one post to each page.');
?>
<?php
//twitter
define('PLG_TW_USER', 'Your Username');
define('PLG_TW_COUNT', 'Twitter Posting Count');
define('PLG_TW_COUNT_T', 'Number of twitts to show');



  //press room lang-----------------------------------------------
  
  define('_MU_PROOM', 'Item Title');
  define('_MU_BelmarAlerts', 'Item Title');
  define('_MU_PROOM_R', 'Please Enter Press Room');
define('_MU_BelmarAlert_R', 'Please Enter Item Title');

define('_MU_PROOM_T', 'enter press room title');
define('_MU_BelmarAlerts_T', 'enter Item Title');

define('_PROOM_TYPE', 'Item Type');
  define('_PROOM_R', 'Please Select Press Room Type');
  define('_PROOM_SEL', '--- Select Press Room Type ---');
  define('_PROOM_SEL_T', 'This menu will link to Following:<br />On-Site Content<br />Off_Site Url<br />File Upload.');
  define('_PROOM_PUB', 'Item Published');
define('_Belmaralerts_PUB','Item Published');
define('Unpublished_time','Unpublish Time');


define('_ON_SITE_CONTENT', 'On-Site Content');
  define('OFF_Site_URL', 'Off-Site URL');
  define('File_Upload', 'File Upload');
  define('_POSTDATE', 'Post[on] Date/Time');
define('_BelmarAlerts_POSTDATE', 'Post[on] Date/Time');

define('_POST_DATE_PROOM', 'enter press Post Date');
define('_POST_DATE_belmarAlerts', 'enter Belmar Alert Post[on] Date/Time');

define('_PROOM_ADD', 'Add Press Room');


define('_BelmarAlert_ADD', 'Add Item');

define('_PROOM_ADDED', '<span>Success!</span>Press Room added successfully!');
define('_BelmarAerts_ADDED', '<span>Success!</span>Belmar Alerts added successfully!');
define('_Public_Works_ADDED', '<span>Success!</span>Public Works added successfully!');
define('_Belmar_Survay_ADDED', '<span>Success!</span>Belmar Survay added successfully!');

define('_PROOM_STATUS', 'Feature on Home Page');
define('_BelmarAlerts_Feature', 'Feature on Home Page:');

define('_PRoom_UPDATED', '<span>Success!</span>Press Room updated successfully!');
define('_Belamrt_UPDATED', '<span>Success!</span>Belmart Alert updated successfully!');
define('PRoom_EM_TITLE', 'Item Title');
define('belamrAlert_EM_TITLE', 'Item Title');

define('Public_EM_FullNAME', 'Name');
define('Bulmersurvey_Dept', 'Department');
define('BulmerSurvey_Email', 'Email');
define('BelmarSurvey_experience', 'Experience');
define('BelmarSurvey_staff', 'Staff');
define('BelmarSurvey_questions', 'Questions');
define('BelmarSurvey_comments', 'Comments');


define('_PRoom_A', 'Active');
define('_Belamr_A', 'Published');
define('_PRoom_I', 'Inactive');
define('_belmaralert_I', 'Unpublished');
define('PRoom_EM_TSTATUS', 'Published');
define('PRoom_EM_TSTATUSUn', 'UnPublished');
define('PRoom_EM_Bublished', 'Published');
define('PRoom_EM_TITLE1','Manage CMS Modules &rsaquo; Press Room/News Manager');
define('PMalingList_EM_TITLE1','Manage CMS Modules &rsaquo; Mailing List');
define('PContactlist_EM_TITLE1','Manage CMS Modules &rsaquo; Form Submission & List &rsaquo; Contact Form List');

define('Palertlist_EM_TITLE1','Manage CMS Modules &rsaquo; Get alerts List');
define('Belmaralert_EM_TITLE1','Manage CMS Modules &rsaquo; Belmar Alerts Manager');
define('PublicWorks_EM_View','Manage CMS Modules &rsaquo; View Public Works');
define('alert_EM_View','Manage CMS Modules &rsaquo; View alerts');
define('alert_EM_Opt_out','Manage CMS Modules &rsaquo; View Opt Out List');

define('BelmarSurvey_EM_View','Manage CMS Modules &rsaquo; View Belmar Survey');

define('publicwork_EM_TITILE','Manage CMS Modules &rsaquo; View Public Works');
define('BelmarSurvey_EM_TITILE','Manage CMS Modules &rsaquo; View Belmar Survey');

define('Proom_EM_INFO1', 'Here you can update your Press item.');
  define('PRoom_EM_TITLE3', 'Manage CMS Modules &rsaquo; Configure Plugin');
  define('Add_New_Press_Room','Add Item');
define('UR_FIND_PressRoomTitle', 'Item Search Title');
define('UR_FIND_belmaralertsTitle', 'Search Item Title');

define('UR_FIND_pageTitle', 'Search page Title');
define('UR_FIND_all', 'Search page Title, Section and user');
define('UR_FIND_first_name', 'Search first name');
define('UR_FIND_contactfname', 'Search First name');
define('UR_FIND_PUBLIC_WORKS', 'Search Public Works Title');
define('UR_FIND_BelmarSurvey', 'Search Belmar Survey First name');
define('UR_FIND_Receiver', 'Search Receiver');
define('UR_FIND_fname', 'Search First name');


define('_Press_Room_title', 'Press Room title');
define('_belamr_Alerts_title', 'Item title');
define('_Press_page_title', 'Page title');
define('_Press_alert_fname', 'Receiver');
define('_Press_opt_out_fname', 'First Name');
define('_Press_opt_out_lname', 'last Name');
define('_Press_contact_fname', 'First Name');
define('_Press_contact_lname', 'Last Name');
define('_Press_contact_email', 'Email');
define('_Press_contact_dep_id', 'Type');
define('_Press_contact_date_created', 'Date Added');
define('_FNAME', 'First name');
//define('_CITY', 'City');

define('_Post_date', 'Post Date');
define('Posted_by', 'Posted By');

define('PLG_EM_INFO3','Here you can view and manage your Press Room/News items');

define('Pevents_EM_INFO3','Here you can view and manage your Event/Calandar items.');
define('Pcontactlist_EM_INFO3','Here you can view and manage your Contact List items.');
define('Pmailingtlist_EM_INFO3','Here you can view and manage your mailing List items.');
define('Palerts_EM_INFO3','Here you can view and manage your Get alerts.');
define('Pbelamralerts_EM_INFO3','Here you can view and manage  your Belmar alerts items.');
    define('PLG_EM_SUBTITLE3', 'Press Room/News Manager &rsaquo;Item List ');
define('PMialinglist_EM_SUBTITLE3', 'Mailing list Manager &rsaquo;Item List ');
define('PcontactList_EM_SUBTITLE3', 'Form Submissions & Lists &rsaquo;Item List ');
define('Pevent_EM_SUBTITLE3', 'Event/Calendar Manager &rsaquo;Item List');
define('Pelmaralerts_EM_SUBTITLE3', 'Belmar Alerts Manager &rsaquo;Item List');
define('GERLAERTS_EM_SUBTITLE3', 'Get Alerts Manager &rsaquo;Item List');

define('PLG_EM_DSTART', 'Post Date');
define('PLG_EM_City', 'City');
define('PLG_EM_State', 'State');


define('PLG_EM_EDIT', 'Edit');
define('PLG_EM_PRoom', 'Press Room');
define('PBelmart_Alerts', 'Belmar Alert Item');
define('PLG_EM_BelmarAlert', 'Belmar Alerts');

define('PLG_EM_Publicworks', 'Public works');
define('PLG_EM_belmarsurvey', 'Belmar Survey');
define('PLG_EM_Contact', 'Contact');


define('PRoom_EM_SUBTITLE1','Edit Press Room Item &rsaquo;');
define('BelmarAlert_EM_SUBTITLE1','Edit Belmar Alert Item &rsaquo;');
define('Opt_Out_List_EM_SUBTITLE1','View Opt Out Item &rsaquo;');

define('alert_EM_SUBTITLE1','view alert Item &rsaquo;');
define('BelmarSurvey_EM_SUBTITLE1','Edit Belmar Survey Item &rsaquo;');
          define('PRoom_EM_UPDATE', 'Update Press Room');
define('BelmarAlerts_EM_UPDATE', 'Update Belmar Alerts');

define('PLG_EM_TITLE2', 'Manage CMS Modules &rsaquo; Press Room/News Manager');
define('PLG_EM_TITLEalert', 'Manage CMS Modules &rsaquo; Belmar Alerts Manager');

define('PLG_EM_INFO2', 'Here you can add a Press Room/News Item.');

             define('PLG_EM_SUBTITLE2', 'Press Room/News Manager&rsaquo; Add New Item ');

define('PELMARALERTs_EM_SUBTITLE2', 'Belmar Alerts Manager &rsaquo;Add New Item');
               define('_PR_INFO1', 'Here you can update your PressRoom\'s info.');
define('_Opt_Out_INFO1', 'Here you can View your Opt Out List\'s info.');

define('_Bemalerts_INFO1', 'Here you can add your Belmar Alerts\'s info.');


define('_POSTED_BY','Posted By');
define('_pressroom','Press Room');
define('_File_Upload','File Upload');
define('_Valid_Reason','Please Enter at least one reason');
define('_Valid_fname','Please Enter First name');
define('_Valid_lname','Please Enter Last name');
define('_Valid_email','Please Enter Email');
define('_Valid_address','Please Enter Address');
define('_Valid_department','Please Enter department');
define('_Valid_city','Please Enter City');
define('_Valid_zipcode','Please Enter Zip code');
define('_Valid_phone','Please Enter full Telephone');
define('_Valid_format','Please Enter Numeric Telephone');
define('_Valid_format_Mobile','Please Enter Numeric Mobile');
define('PLG_EM_NOEVENT2', '<span>Info!</span>You don\'t have any Public Works yet. Please add!');
define('Pemaralerts_EM_NOEVENT2', '<span>Info!</span>You don\'t have any Belmar alerts items yet. Please add!');

define('PLG_EM_NOEVENT_BelmarSurvey', '<span>Info!</span>You don\'t have any Belmar Survey yet. Please add!');
define('emailaddress','Email');
define('mobile','Mobile');
define('address','Address');
define('city','City');
define('state','State');
define('zip_code','Zip code');
define('telephone','Telephone');
define('location','Location');
define('message','message');
define('reason_for_submition','reason for Submition');
define('other','Other');
define('alertme','Alert Me');
define('alertvia','Alert via');


define('_C_ACTION','Choose Action:');
define('_BY_KEYWORD','Search By Keyword:');
define('_BY_SECTION','Show By Section:');


define('_PUB','Publish');
define('_UNPUB','Unpublish');


?>