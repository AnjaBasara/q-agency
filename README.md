# PHP test assignment

### Running the Dockerized application

To run this application, you should have [Docker](https://www.docker.com/) installed.

---

After cloning the repository, open the `q-agency` folder and run this command:

`docker-compose up -d`

After that, open the application in your browser by visiting http://localhost:8000/

---

To run the CreateAuthor artisan command, execute the Docker container interactively by running the command:

`docker exec -it <container_name> bash`

where <container_name> is the name of the above created container.

> To see the name of the container, use `docker container ls` command to list all the containers and their names.

and then call the command:

`php artisan author:create`

---

Thank you for your time!