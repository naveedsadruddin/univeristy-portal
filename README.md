This is univeristy portal where a 
user can enroll and see their enrolled courses,
Instructor can create , edit and delete courses and see enrollements of their courses
Admin can de enroll students , create users , roles , courses and grant user courses and roles

TO install this the minimum php requirement is 8.1
First you need to clone this repository
please copy .env.example and rename it to .env

change database name in .env as your preferred name in variable DB_DATABASE and do database configration as asked

Then 
composer install, 

then
Php artisan migrate,    

then
php artisan db:seed,   

then 
php artisan key:generate,     

then
npm install,                

then
php artisan serve,   

then 
npm run dev,

Now you have all the needed users 
admin user:
email:
admin@admin.com
password: password

instructor:
email:
instructor@instructor.com
password: password

student:
email:
student@student.com
password: password

New user created have role of students 

Changing role of user can be done by admin on user link on side bar by editing user and assigning role

Admin and Instructor can create courses

New Can join the availible courses by enrolling into them and can also see the courses they are enrolled in

Instructors can create Courses and see who are enrolled in their courses

First step will be creating courses then studenrs and enroll into them then admin can de enroll them
