---
status: inprogress
---

## Basic commands
- To check available docker images:
```bash
docker images
```

- To check running containers
```bash
docker ps
```

- To get a docker image from the docker repo:
```bash
docker pull [name]:{tag}
```

```bash
# example
docker pull nginx:1.23
```

- To run the image container:
```bash
docker run [name]:{tag}
```

```bash
# example
docker run nginx:1.23
```

- To run a docker image container in the background:
```bash
docker run -d | --detach [name]:{tag}
```

- To see __Logs__ of a container that runs in the background:
```bash
docker logs -f <container_id>
```
the `-f` allows you to follow the logs real time

- To stop a container:
```bash
docker stop <container_id1> <container_id2>
```
- To __kill__ a running  container, (do this as a last resort):
```bash
docker kill <container_id> | <container_name>
```

- To remove a container from disk:
```bash
docker rm <container_id> | <container_name>
```

- To bind the container port with our localhost port:
```bash
docker run -p | --publish [port]:[cport] [name]:{tag}
```

- To list all containers available on a system:
```bash
docker ps -a | --all
```
or
```bash
docker container ls -a
```

- To reuse an existing container:
```bash
docker start <container_id> | <container_name>
```

- To give a container a name on create time:
```bash
docker run --name <descriptive_name> [name]:{tag}
```

## Creating a Dockerfile for a custom image

- To use a base image:
```Dockerfile
FROM [name]:{tag}
```

- To run commands on the container console:
```Dockerfile 
RUN <command> <flags>
```

- To copy local files to container:
```Dockerfile 
COPY local/file/path/ dest/container/path/
```
_the slash at the end of dest folder tell docker to create folder if doesn't exist_

- To `cd` into a directory:
```Dockerfile 
WORKDIR /path/to/dir
```

- To run the final command that starts our application on the docker container:
```Dockerfile 
CMD ["command", "flags", "misc"]
```
_the commands are supplied in a array of comma separated strings_

## Build from Dockerfile 
- To build form a Dockerfile:
```bash
docker build -t | --tag [name-for-image]:{tag} /path/to/dockerfile
```

## Docker volumes

---
#cheatsheet #docker 