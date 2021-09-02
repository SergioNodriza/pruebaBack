#!/bin/bash

mkdir -p ~/tools
cd ~/tools
git clone https://github.com/awslabs/amazon-ecr-credential-helper.git
cd amazon-ecr-credential-helper

make docker || (echo -e "\n\n    ERROR al compilar el credential helper\n\n" && exit 5)
sudo ln -fs "$(realpath ./bin/local/docker-credential-ecr-login)" /usr/local/bin/docker-credential-ecr-login

mkdir -p ~/.docker
cat > ~/.docker/config.json <<EOL
{
    "credsStore": "ecr-login"
}
EOL

