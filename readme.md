#### prerequisites
install docker and docker-compose

#### Installation 
 1- clone the project
 
    $ git clone https://github.com/abdelrahmanbadr/BookApp
    
 2- copy the .env file 
 
    $ cp .env.example .env
 
3- run the following command `make init` (this command will build , make host for the app, up docker-compose in background,
composer install, change permission for storage and public folder and finally will run database migration)

You can now access the solution from the browser via: `http://yaraku-task.local:8090/books`

Notice: in case it did not work you'll just need to update your hosts file `/etc/hosts` with `127.0.0.1 yaraku-task.local`
you can replace `127.0.0.1` with your docker host machine ip.

#### Query Parameters
```
search              searches books
            e.g.:   http://yaraku-task.local:8090/books?search=code&searchFields=title,authorName
            e.g.:   http://yaraku-task.local:8090/books?search=clean&searchFields=title
            e.g.:   http://yaraku-task.local:8090/books?search=martin&searchFields=authorName
            
sort                sorts the books by either title or authorName
            e.g.:   http://yaraku-task.local:8090/books?sort=title (ascending is the default)
            e.g.:   http://yaraku-task.local:8090/books?sort=+authorName (ascending)
            e.g.:   http://yaraku-task.local:8090/books?sort=-authorName (descending)
            
filter              filter books by specific fields
            e.g.:   http://yaraku-task.local:8090/books?filters=title:design
            e.g.:   http://yaraku-task.local:8090/books?filters=authorName:pop,title:design
      
```

#### Design Pattern
- Filter Desgin Pattern (Criteria pattern): To make sort, search and filter books.
- Factory Desgin Pattern : To create object without exposing the creation logic eg BookService, ExcelService and XmlService     objects.
- Repository: To abstract the data layer, making our application more flexible to maintain.

#### Project structure
- Domain : The domain layer is the heart of the software, and this is where the interesting stuff happens.
- Constants : Has all constants related to the book domain.
- Contracts : Has all interfaces of book domain.
- Entities : Has all entity models of book domain.
- Exceptions : Has custom exceptions.
- Mappers : Mapping books to array of book objects. 
- Repositories : Has BaseEloquentRepository and EloquentBookRepository
- Services :  Services  used to hide and encapsulate App Logic 

#### These are the other available command you might need in the future
- stop all containers `make stop_all_containers`

- remove all containers `make clear_containers`

- remove all images `make clear_images`

#### Running Unit tests:
    $ make phpunit_test
 
#### Improvments(@todo):
    1. Add cli command to export data to xml and csv
    2- Separate author in another table and make his name is unique
    3- Make more enhancment in UI (i made a simple UI) 
    4- Add more logs to trace errors
    5- Write more test cases to increase code coverage
#### Should Have :
    1- Cache books if not changes (Cache::remember)
    2- Add php artisan db:seed (to fill books table)
    3- Add soft delete
    
