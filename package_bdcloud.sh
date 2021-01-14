#!/usr/bin/env bash

TARGET="manchuworkweb"
ROOT_PATH=`dirname "$0"`
cd $ROOT_PATH
PROJECT_ROOT_PATH=`pwd`

cd ${PROJECT_ROOT_PATH}/..
APP_BASE=`pwd`
#APP_TMP_DIR=$APP_BASE/tmp
TARGET_BASE_DIR="$APP_BASE/$TARGET"
echo "ROOT_PATH:$ROOT_PATH"

#echo "APP_BASE:$APP_BASE"
echo "PROJECT_ROOT_PATH:$PROJECT_ROOT_PATH"

echo "mkdir -pv "$TARGET_BASE_DIR
mkdir -pv $TARGET_BASE_DIR
echo "TARGET:$TARGET"

rm -rf $TARGET_BASE_DIR/*
`cp  -Rf $PROJECT_ROOT_PATH/ $TARGET_BASE_DIR`

#清理文件
rm -rf $TARGET_BASE_DIR/.env
rm -rf $TARGET_BASE_DIR/.env.example
rm -rf $TARGET_BASE_DIR/.gitattributes
rm -rf $TARGET_BASE_DIR/.gitignore
rm -rf $TARGET_BASE_DIR/.htaccess
rm -rf $TARGET_BASE_DIR/.idea

rm -rf $TARGET_BASE_DIR/public/css_bak

rm -rf $TARGET_BASE_DIR/storage
#rm -rf $TARGET_BASE_DIR/storage/app/public/*
#rm -rf $TARGET_BASE_DIR/storage/framework/sessions/*
#rm -rf $TARGET_BASE_DIR/storage/framework/views/*

#rm -rf $TARGET_BASE_DIR/.*
rm -rf $TARGET_BASE_DIR/node_modules

rm -rf $TARGET_BASE_DIR/.git

rm -rf $TARGET_BASE_DIR/bootstrap/cache/*


cd $TARGET_BASE_DIR
C=`pwd`
echo "now path $C"

## 删除无用目录
rm -rf $TARGET_BASE_DIR/tests
#ln -s $TARGET_LARAVEL_DIR/storage/app/public $TARGET_BASE_DIR/storage

# 准备打包
cd $TARGET_BASE_DIR/
echo `pwd`
echo "rm $APP_BASE/${TARGET}.zip"
rm $APP_BASE/${TARGET}.zip
zip -r $APP_BASE/${TARGET}.zip *
echo "$APP_BASE/${TARGET}.zip"

echo "bdcloud finished"

