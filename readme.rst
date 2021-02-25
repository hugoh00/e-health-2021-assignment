###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************

Please see the `installation section <https://codeigniter.com/user_guide/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.

**********************
Accessing the Project
**********************

The database hasn't been altered so there's no need to import the script into phpmyadmin
Unless you wanted to use my data. 

localhost/e-health/ to access the homepage where you can login/register

*****
Admin
*****

It is assumed the admin has an email of xxxx@ehealth.com
That is what the check for admin is specifically looking 

In a proper system there would obviously be email confirmation and maybe if there were going to be 
more admins they would be directly inserted into the database. Maybe even have a different table for 
them.

*****
Users
*****

They can sign in with their username and password which you can get from the db or make a new user and 
login with those details

**********
Dashboard
**********

Every user goes to the Dashboard but will get a slight difference in navigation bars.

Admin -> Dashboard - Data - Completed Questionnaires - Logout
User -> Dashboard - Questionnaire - Logout

Dashboard is just a basic staging post to send the admin/user elsewhere
Data is where the graphs will be shown
Completed Questionnaires is shown !!!! I have set users to Pending or Accepted in status
maybe my db data will be required 
Questionnaire - If admin accesses this it will be all locked If User accesses it they will
be able to enter details into the questionnaire Once submitted the questionnaire inputs
will all be disabled unless admin rejects the questionnaire then they will be set to Rejected
