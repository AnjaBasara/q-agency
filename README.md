# PHP test assignment

### Running the Dockerized application

To run this application, you should have [Docker](https://www.docker.com/) installed.

---

After cloning the repository, open the `q-agency` folder and run this command:

`docker-compose up`

After that, open the application in your browser by visiting http://localhost:8000/

---

To run the CreateAuthor artisan command, execute the Docker container interactively by running the command:

`docker exec -it laravel-app bash`

and then call the command:

`php artisan author:create`

---

Thank you for your time!