#### prerequisites
install docker and docker-compose

#### Installation 
 1- clone the project
 
    $ git clone https://github.com/abdelrahmanbadr/BookApp
    
 2- copy the .env file 
 
    $ cp .env.example .env
 
3- run the following command `make init` (this command will build , make host for the app, up docker-compose in background,
composer install, change permission for storage and public folder and finally will run database migration)

You can now access the solution from the browser via: `http://yaraku-task.local:8090\books`

Notice: in case it did not work you'll just need to update your hosts file `/etc/hosts` with `127.0.0.1 yaraku-task.local`
you can replace `127.0.0.1` with your docker host machine ip.

#### These are the other available command you might need in the future
- stop all containers `make stop_all_containers`

- remove all containers `make clear_containers`

- remove all images `make clear_images`

#### Running Unit tests:
    $ make phpunit_test
 
#### Improvments:
    1. Add cli command to export data to xml and csv
    2- Separate author in another table and make his name is unique
    3- Make more enhancment in UI (i made a simple UI) 
    4- Add more logs to trace errors
    5- Write more test cases to increase code coverage
