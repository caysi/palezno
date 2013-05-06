#!/bin/bash
fusermount -u $HOME/sshfs

# Получение пароля
#stty -echo
#printf "Password: "
#read PASSWORD
#stty echo
#printf "\n"

sshfs $1:/ $HOME/sshfs
ssh $1
fusermount -u $HOME/sshfs
