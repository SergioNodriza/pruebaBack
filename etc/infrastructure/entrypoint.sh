#!/bin/sh

SUPERVISORCTL="supervisorctl -u ${SUPERVISOR_USERNAME:?} -p ${SUPERVISOR_PASSWORD:?}"
SUPERVISORD_CONNECTION_RETRIES=15

# start supervisord in background
echo Starting supervisord

/usr/bin/supervisord -c /etc/supervisord.conf &
pid=$!

# wait for supervisord to accept connections
echo Waiting for supervisord to accept connections

retries=$SUPERVISORD_CONNECTION_RETRIES
while [ $retries -ne 0 ]; do
  # get supervisord version with supervisorctl
  $SUPERVISORCTL version > /dev/null 2>&1

  # exit code 4 = refused
  if [ $? -ne 4 ]; then
    break
  fi

  # sleep and retry
  sleep 1s
  retries=$((retries - 1))
done

# check connection status
if [ $retries -eq 0 ]; then
  # error connecting to supervisord, exit
  >&2 echo Can not connect to supervisord
  exit 4
fi

echo Connected to supervisord

# check and start supervisord programs
if [ -n "${AUTOSTART}" ]; then
  for program in $(echo "$AUTOSTART" | tr , ' '); do
    echo Starting supervisord program: "$program"

    $SUPERVISORCTL start "$program"

    # check code
    if [ $? -ne 0 ]; then
      >&2 echo Error starting supervisord program: "$program"

      exit $?
    fi
  done
else
  echo No supervisord programs to be started
fi

# wait for supervisord process to exit
wait $pid
echo supervisord exited with code $?

# shellcheck disable=SC2181