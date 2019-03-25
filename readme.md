## SETUP INSTRUCTIONS


#1. Clone GitHub repo for this project locally
git clone https://github.com/umair87/laravel.git/ projectName

#2. cd into your project
cd project-name

#3. Install Composer Dependencies
composer install

#4. Install nodejs go to http://nodejs.org

#5. Install NPM Dependencies
npm install

#6. Start up Webpack
webpack --watch

#7. Create a .env file that we can start to fill out to do things like database configuration
cp .env.example .env
This will create a copy of the .env.example file in your project and name the copy simply .env

#8. Generate an app encryption key
php artisan key:generate

#9. Create an empty database for our application

#10. In the .env file, add database information to allow Laravel to connect to the database

#11. Migrate the database
php artisan migrate

#12. Import the database from the provided SQL dump file.

#13. Create a virtual host
Assuming that you have installed xampp in D: drive. So go to D:\xampp\apache\conf\extra\httpd-vhosts.CONF file
and add the following code

<VirtualHost *:80>
    ServerName your-project-name.test
    DocumentRoot "D:\xampp\htdocs\your-project-directory-name\public"
    SetEnv APPLICATION_ENV "development"
    <Directory "D:\xampp\htdocs\your-project-directory-name\public">
         DirectoryIndex index.php
         AllowOverride All
         Order allow,deny
         Allow from all        
     </Directory>
</VirtualHost>


Then go to "C:\Windows\System32\drivers\etc" and edit the hosts file as an administrator
Add the following line:
127.0.0.1		your-project-name.test

#14. You should be ready to run the app now.


## APP DESCRIPTION

-- On the main page the top section is for FEATURED POSTS. Only 5 latest featured posts will appear here. All other posts which are not featured will appear in the below section.

-- If you will click any post, you will be redirected to the full post.

-- Each post has atleast 5 tags and each post is associated with one topic. The topics are mentioned in the top navigation menu.

-- If you will click any topic from the top navigation menu, you will be redirected to a page where you will see all the posts associated with that particular topic.

-- On the full post page, you will see the tags associated with the particular post in the very bottom of the page. If you will click any tag button, you will be redirected to the page where you will see all the posts associated with that particular tag.

-- User will have to login to create a new post. While creating a post, on the first page user will have to enter the title of the post, select topic and assign atleast 5 tags for the post. On the next page, the user will be able to add images/text for that post. By default the new post will not be published unless approved by the admin.

-- For the admin user, we have an additional Admin Dashboard which will be visible to the admin only. The credentials for the admin user are as follows:

Email: umair_kureshi@hotmail.com
Password: 12345678

When you will login as an admin, you will be able to access the Admin Dashboard where you will see all the posts. From there, you can peform the following actions:
	--- Check the content of post
	--- Publish/Unpublish any post
	--- Feature/Unfeature any post
	--- Delete any post
	--- Update the content of any post