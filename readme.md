### Installation

#### prerequisites
install docker 

#### steps ton run the solution

1. run the following command `make init` (this command will build , make host for the app, up docker-compose in background, change permission for storage and public folder and finally will run database migration)

You can now access the solution from the browser via: `http://yaraku-task.local:8090\books`


Notice: in case it did not work you'll just need to update your hosts file `/etc/hosts` with

`127.0.0.1 yaraku-task.local`

you can replace `127.0.0.1` with your docker host machine ip.

#### These are the other available command you might need in the future

- stop all containers `make stop_all_containers`

- remove all containers `make clear_containers`

- remove all images `make clear_images`

- run unit tests `make phpunit_test`
