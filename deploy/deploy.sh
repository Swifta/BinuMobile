#!/bin/bash

# deploy script wrapper
# install deploy sync
#
# Joe Lipson 2013

# get the directory for the source code
function get_app_dir() {
  APP_DIR="`dirname \"$0\"`"
  APP_DIR="`( cd \"$APP_DIR\" && pwd )`"
  APP_DIR="`dirname \"$APP_DIR\"`/"

  if [ -z "$APP_DIR" ] ; then
    # error; for some reason, the path is not accessible
    echo "couldnt access dir $APP_DIR"
    exit 1  # fail
  fi
}

get_app_dir

if [ ! $1 ] ; then
  RELEASE_TAG=`git describe`
  echo Specify tag to release \( latest is `git describe` \)
  exit;
else
  RELEASE_TAG=$1
fi

if [ ! $2 ] ; then
  echo 'Specify action ( [install|remove|deploy|sync|show|tail_access|tail_error] )'
  exit;
else
  ACTION=$2
fi

PROJ_NAME=`git remote -v | head -n1 | awk '{print $2}' | sed 's/.*\///' | sed 's/\.git//'`

$APP_DIR/deploy/git-app0.sh -a $PROJ_NAME -r $RELEASE_TAG -m $ACTION -d prod

#bash_wrapper -a app_name -r release_tag -m [install|remove|deploy|sync|show|tail_access|tail_error] -d [dev|test|prod]
exit

