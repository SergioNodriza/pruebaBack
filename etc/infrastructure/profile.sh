# aliases
alias sf="php bin/console"
alias behat="APP_ENV=test ./vendor/bin/behat"

# prompt
NORMAL="\[\e[0m\]"
RED="\[\e[1;31m\]"
GREEN="\[\e[1;32m\]"
if [ "$(whoami)" = root ]; then
        PS1="$RED\u@\h [$NORMAL\w$RED]# $NORMAL"
else
        PS1="$GREEN\u@\h [$NORMAL\w$GREEN]\$ $NORMAL"
fi
