#!/bin/bash
fusermount -u $HOME/sshfs

# Получение пароля
#stty -echo
#printf "Password: "
#read PASSWORD
#stty echo
#printf "\n"

if [ $2 ]
then
	KEY="-i $2 "
	KEYFS="-o IdentityFile=$2 "
else
	KEY=""
	KEYFS=""
fi
sshfs $KEYFS$1:/ $HOME/sshfs
ssh $KEY$1
fusermount -u $HOME/sshfs
