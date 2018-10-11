#!/usr/bin/env bash

TARGET_BASE="m_target"
TARGET="$TARGET_BASE/laravel"
ROOT_PATH=`dirname "$0"`
cd $ROOT_PATH
BIN_PATH=`pwd`

cd ${BIN_PATH}/..
APP_BASE=`pwd`
#APP_TMP_DIR=$APP_BASE/tmp
TARGET_LARAVEL_DIR="$APP_BASE/$TARGET"
TARGET_BASE_DIR="$APP_BASE/$TARGET_BASE"
echo "ROOT_PATH:$ROOT_PATH"
echo "TARGET_LARAVEL_DIR:$TARGET_LARAVEL_DIR"

#echo "APP_BASE:$APP_BASE"
echo "BIN_PATH:$BIN_PATH"

`mkdir -pv $TARGET`
echo "TARGET_LARAVEL_DIR:$TARGET_LARAVEL_DIR"
echo "TARGET_BASE_DIR:$TARGET_BASE_DIR"


rm -rf $TARGET_BASE_DIR/*
`rm -rf $TARGET_LARAVEL_DIR/*`
`cp  -Rf $BIN_PATH/ $TARGET_LARAVEL_DIR`

#清理文件
rm -rf $TARGET_LARAVEL_DIR/.env
rm -rf $TARGET_LARAVEL_DIR/.env.example
rm -rf $TARGET_LARAVEL_DIR/.gitattributes
rm -rf $TARGET_LARAVEL_DIR/.gitignore
rm -rf $TARGET_LARAVEL_DIR/.htaccess
rm -rf $TARGET_LARAVEL_DIR/.idea

rm -rf $TARGET_LARAVEL_DIR/public/css_bak

rm -rf $TARGET_LARAVEL_DIR/storage/app/public/*
rm -rf $TARGET_LARAVEL_DIR/storage/framework/sessions/*
rm -rf $TARGET_LARAVEL_DIR/storage/framework/views/*


rm -rf $TARGET_LARAVEL_DIR/storage/logs/*


#rm -rf $TARGET_BASE_DIR/.*
rm -rf $TARGET_LARAVEL_DIR/node_modules

cd $TARGET_LARAVEL_DIR
C=`pwd`
echo "now path $C"

# 移动public 目录
mv $TARGET_LARAVEL_DIR/public/* ../
# 修改public 目录后，修改对应的文件
mv $TARGET_LARAVEL_DIR/tests/package/index.php $TARGET_LARAVEL_DIR/../index.php
mv $TARGET_LARAVEL_DIR/tests/package/server.php $TARGET_LARAVEL_DIR/server.php

# 修改为线上配置
mv ~/.env $TARGET_LARAVEL_DIR/.env

## 删除无用目录
rm -rf $TARGET_LARAVEL_DIR/tests
#ln -s $TARGET_LARAVEL_DIR/storage/app/public $TARGET_BASE_DIR/storage

# 准备打包
cd $TARGET_BASE_DIR/
echo `pwd`
echo "rm $APP_BASE/${TARGET_BASE}.zip"
rm $APP_BASE/${TARGET_BASE}.zip
zip -r $APP_BASE/${TARGET_BASE}.zip *
echo "$APP_BASE/${TARGET_BASE}.zip"

echo "finished"

