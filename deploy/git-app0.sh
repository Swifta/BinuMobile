#!/bin/sh
#
# git-app0.sh
#
# This is a template file which can be download into your current dev0 environment.
# This version is ready for deployment to app0.
# To deploy to other hosts (such as web0) the parameters DEST_LOGIN and DEST_HOST need changing.
#
# Pre-requisites:
# - git access via your private ssh key
# - remote deployment access via your private ssh key
# - remote deployment initialisation of the app you wish to release
# - agreement with binu Ops regarding your app configuration needs
# - an xml config file (such as apps.error_page.config.xml) defined for your app and loaded into git under the apps.deploy project
#

SSH_PORT=2222
DEST_LOGIN=apps
DEST_HOST=app0.binu.net
SCRIPT="bin/deploy/deploy_tools.sh"

set -x

ssh -p ${SSH_PORT} ${DEST_LOGIN}@${DEST_HOST} ${SCRIPT} $@

