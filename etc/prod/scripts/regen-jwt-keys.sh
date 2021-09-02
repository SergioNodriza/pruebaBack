#!/bin/bash

p=$(grep JWT_PASSPHRASE ~/config/auth/.env | cut -d= -f2)

if [[ -z $p ]]; then
    echo 'Empty $JWT_PASSPHRASE in ~/config/auth/.env'
    exit 5
fi

echo "$p" | openssl genpkey -out ~/config/auth/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 \
&& echo $p | openssl pkey -in ~/config/auth/jwt/private.pem -passin stdin -out ~/config/auth/jwt/public.pem -pubout \
&& echo 'Done'

