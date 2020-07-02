## Run this project in Homestead

Instruction:
- Go to your Homestead file location in your local machine
- Run vagrant up --provision to run homestead
- Run vagrant ssh
- Select a folder directory to save the project
- Clone the project repository on the selected folder with link: https://github.com/rinagreen/books.git
- Go to the cloned project and run Composer update
- Create databas, named as books or any of you choice.
- Update .env with your database name, username and password
- Run php artisan migrate to generate tables 
- Run php artisan db:seed --class=DatabaseSeeder to create dummy data for the tables
- Add books.test in your Homestead.yaml file including the directory to include the project in the sites to map 
- Update your host file and add `192.168.10.10  books.test`
- exit from vagrant and run vagrant up --provision
- Run books.test in your browser 

 