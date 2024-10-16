Step-1: Download the project file and unzip or clone the project using git bash
Step-2: Copy and paste the env.example file and rename it to .env
Step-3: Inside the .env file change the DB_CONNECTION=sqlite to DB_CONNECTION=mysql and uncomment the following lines DB_HOST=127.0.0.1 DB_PORT=3306 DB_DATABASE=laravel DB_USERNAME=root DB_PASSWORD=. Change the DB_DATABASE=laravel to DB_DATABASE=covid
Step-4: Open command prompt in the folder of the project and run the command php artisan key:generate.
Step-5: In the .env file change the lines MAIL_MAILER=smtp, MAIL_HOST=smtp.gmail.com, MAIL_PORT=587, MAIL_ENCRYPTION=tls
Step-6: Now the google's smtp need to be set up in order to setup the host. Log in to your gmail and turn on 2-step verification. Now go to App Passwords and create a new app. Copy the password provided by gmail smtp.
Step-7: Paste the password in MAIL_PASSWORD= and remove the gaps in between. Then paste your gmail in the MAIL_USERNAME=.
Step-8: Run the command php artisan migrate.
Step-9: Run the command php artisan db:seed --class=CenterSeeder
Step-10: Run the command php artisan serve.
Step-11: Register as a user.
Step-12: Since the project is set up in dev server the automation command must be executed manually. Run the command php artisan app:appointment-scheduler.
Now everything should be running as intended.

In order to optimize user registration and search database indexing has been implemented. 

Vonage can be used to implement sms notification. 
