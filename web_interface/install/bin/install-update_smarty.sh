#!/bin/bash

# this script will install the Smarty templating engine

VERSION="3.1.6"
FILENAME="Smarty"
ADDRESS="http://www.smarty.net/files/Smarty-${VERSION}.tar.gz"
USECACHED="false"

mkdir tmp
cd tmp

if [ $USECACHED == "false" ]; then 
  rm -f *
  wget "$ADDRESS"
fi

tar zxf "$FILENAME-$VERSION.tar.gz"
rm -rf ../../../admin/include/Smarty
mkdir  ../../../admin/include/Smarty
cp -af $FILENAME-$VERSION/libs/* ../../../admin/include/Smarty
rm -rf $FILENAME-$VERSION
rm $FILENAME-$VERSION.tar.gz -f
echo "Done"
