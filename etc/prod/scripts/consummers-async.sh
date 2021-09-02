#!/bin/bash

NPROCS=50
MESSAGES=1000
TIME=300
QUEUE=async

CONTAINER=api
USER=1000
SLEEP=0.5s

while getopts p:m:t:q: option; do
    case "${option}" in
        p) NPROCS=${OPTARG};;
        m) MESSAGES=${OPTARG};;
        t) TIME=${OPTARG};;
        q) QUEUE=${OPTARG};;
        ?) echo -e "usage:\n  $0 [-p <processes>] [-m <messages>] [-t <time>]"
           exit 5;;
    esac
done

for (( i=1; i<=NPROCS; i++ )); do
  echo [$i/"$NPROCS"]
  docker exec -t -u$USER $CONTAINER /usr/bin/php bin/console messenger:consume --limit="$MESSAGES" --time-limit="$TIME" "$QUEUE" > /dev/null &
  sleep $SLEEP
done
