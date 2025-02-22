Here are some *checks* on how to harden a docker instance
1. Never run/launch a docker instance with a **privileged user**, also always _**build**_ your docker images from a custom Dockerfile.
- Say from a custom Dockerfile:

```Dockerfile 
FROM distro
# create an unprivileged user and grant sudo if needed
RUN groupadd -r user && useradd -r -g sudo user user

# set env variables
ENV HOME /home/user
```
- Then do the regular `build` process.
- Then run with the user
```bash
docker run -it -u \
	user <image-id> \
	/bin/bash
```
**OR**
- Simply **block** access to the `root` user completely
```Dockerfile 
# configs above

# blocking root user access
RUN chsh -s /usr/sbin/nologin root
# more configs 
```


2. Never run a docker container in `privileged` mode. This allows the users in the container to run *kernel capabilities* operations.
- Thou can run docker containers in privileged mode usind the `--privileged` flag. There is not much reason to do that and can be catastrophic. 
- Block it using
```bash
docker run -u user \
	-it --security-opt=no-new-privileges \
	<image-id> \
	/bin/bash
```
**OR**
- When some capabilities are needed, you can *drop all* and *add some* with these flags:
```bash
docker run -it -u user \
	--cap-drop all \
	--cap-add <CAP_NAME> \
	<image-id> \
	/bin/bash 
```

3. Make a container **read-only**(THIS DOESN'T APPLY TO ALL CASES). In situations where you want your container to only read from its filesystem and not be able to make any change, you can run it with the `--read-only` flag like:
```bash
docker run --read-only \
	-it -u user \
	<image-name> \
	/bin/bash
```
**OR** (recommended )
- Make the container read-only and allow a *temporary folder* where write functionalities are permitted:
```bash
docker run --read-only \ 
	--tmpfs /opt -it \ 
	-u user <image-name> \
	/bin/bash
```

1. Isolate running containers on segmented networks.
- Isolated networks are created running:
```bash
# later ...
```

---
#docker #cheatsheet 