# Intro
> If you have any questions or need to communicate with me, please do so through email [jbennett@wilbergroup.com](mailto:jbennett@wilbergroup.com) or if you want to chat, [add me on telegram](https://telegram.me/jacobbennett) @jacobbennett.
> 
Thanks for taking the time to complete this code challenge. This represents real work that would be completed for this position. Your goal is to complete this task within two weeks of the time you receive it. Please keep track of your time and **give yourself a deadline of 10 hours**. You will be paid for your 10 hours of work at a rate of $50 an hour for this project. Do your best to complete all requirements, and feel free to reach out any time if you have any questions that you need answered. Let's get to it!

# Setup
>During `composer install` you will be asked for an api_key for Laravel Nova, please use email `jacob.j.bennett@gmail.com` and password of `TIYsWkKLXEMBKkrMvNbInNJUECyGJubqMedCubAO`

1. Run `cp .env.example .env && composer install`
2. Run `php artisan key:generate`
3. Create a local database and update your `.env` 
4. Run`php artisan migrate --seed`
5. Run `npm install && npm run prod`

# Scope

> **Note:** Some items in this project are intentionally vague to determine how familiar you are with Laravel conventions. This does not mean you should not ask clarifying questions. Please communicate as much or as little as you need to.

## Purpose:
The purpose of this application is to give users the ability to track their time based activity throughout the day. This is not an application that will be used to track time clocked-in or clocked-out, but rather, used to track how long particular assigned tasks are taking to complete. This data can then be used to indicate demand for particular job functions, and help to measure how long these job functions will take to complete in the case of a backlog of work.

## Plan:

### Users
The very simple strategy for accomplishing this goal is to provide an interface for users to:
1. Select from a dropdown list of pre-defined activities (create an `activities` table).
2. Press a start button to create a new record, associated to the authenticated user by `user_id`, with the `activity_id` and a `started_at` timestamp in the database (create a `timesheets` table).
3. Press a stop button to update the previous record with a `finished_at` timestamp.

You can use whatever front end stack you would like. Feel free to use blade, livewire, alpine, vue, inertia, tailwind, whatever you are comfortable with. You will need to set up this front-end stack inside of the project.

### Admins and Manager Permissions (Laravel Policies)
Only Admins and Managers should be allowed access to Nova. You can determine who is an admin or manager by looking at the `role` column in the `users` table.

**Admins** - Admins have no restrictions whatsoever inside of Nova. Admins will also be responsible for managing the `activities` table.

**Managers** - Managers should only be able to view or update timesheet data.

### Reporting
Inside of Nova, I would like a [card created](https://nova.laravel.com/docs/3.0/customization/cards.html) that will allow managers to generate a daily report of user activity. The [Laravel Excel Package](https://laravel-excel.com/) can be used to generate this report into an excel sheet.  
The report should be grouped by user and should include the following pieces of information:

1. User Name
2. Activity Name
3. Minutes Spent
4. Files Worked

The number of files worked can be determined by looking at the `legacy_work` table that is provided as a seed for this project. The `legacy_work` table represents actions that users have taken on claims in a third party system. The number of files worked will be represented by the number of unique account numbers present between the start time and end time of a user timesheet record. `legacy_work` files are linked to users by the users initials.

### Testing
Please provide feature tests for controllers that you create outside of Nova, and unit tests for Model methods.

## Extra Info

This project provides Models, Migrations, Factories and Seeders for `users` and `legacy_work`. These should provide you with "real world" values that you can use to get started right away. 

I have also set up a quick way for you to log in as an administrator, manager, or user, by visiting the following links in the application. You DO NOT need to set up a login page for this application.

1. [Admin Login](http://timetracker.test/admin_login)
2. [Manager Login](http://timetracker.test/manager_login)
1. [User Login](http://timetracker.test/user_login)


### Bonus Challenges:

**Policy Restrictions**

In Nova, Managers should only be able to view or update timesheet data for users that have them listed as their manager (match users to managers using the `manager_guid` column).

**Reporting**

In Nova, if the user generating a report has the `role` of `manager`, the report should only include their direct reports. Their direct reports are those users whose `manager_guid` matches up with the `guid` of the authenticated manager. 
If the user has a role of `admin`, the report should generate for all users with activity for the day on which the report is generated.

# Submitting your code

### Pull Request
When you are happy with your code, please submit a Pull Request to this repo, request my review on the pull request. 

### Payment
When your code is finished, Please send an email with your address, and the name you would like on your check so we can remit payment to you. 
