#!/bin/bash
#fusermount -u $HOME/sshfs

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
if [ ! -d $HOME/sshfs/$1 ]
then
	FSDIR=$HOME/sshfs/$1
	mkdir $FSDIR
	sshfs $KEYFS$1:/ $FSDIR

	ssh $KEY$1

	fusermount -u $FSDIR
	if [ ! "$(ls -A $FSDIR)" ]
	then
		rm -r $FSDIR
	fi
else
	ssh $KEY$1
fi
