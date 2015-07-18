#!/bin/sh -e

git submodule init
git submodule update

cd `dirname $0`/../
git add upload/
./submodule/empire-cms-sh/bin/run.sh
