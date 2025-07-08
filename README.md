
---

# Official OpenProfile.AI WordPress Fact Pod Plugin

## WordPress & Apache Configuration

### Requirements

- [Docker](https://www.docker.com/)

### Setup

1. **Project Structure**

   Make sure your folders are organized as follows (both at the same directory level):

    ```
    root/
    ├── wordpress-env/
    └── wordpress-fact-pod/
    ```

    - `wordpress-env/`: Contains your WordPress Docker environment (including `docker-compose.yml`).
    - `wordpress-fact-pod/`: Contains the plugin source code.

2. **Create your own `.env` file:**

    ```sh
    cp .env.sample .env
    ```

3. **Set the Hostname**

    - The site will be available at: `http://docker.vm`
    - Add the following line to your `/etc/hosts` file:
      ```
      127.0.0.1 docker.vm
      ```

4. **Start and Stop Docker Containers**

    ```sh
    make up     # Start the containers
    make down   # Stop the containers
    ```

5. **Default Credentials**

    - **Username:** `Vasyl`
    - **Password:** `1111`

---

Now you can access your site at [http://docker.vm](http://docker.vm).

Happy coding! 🚀

---