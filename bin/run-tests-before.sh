#!/bin/bash

install_plugin() {
    plugin_name=$1

    mkdir -p target/plugins

    [ -d "target/plugins/$1/" ] && return;

    rm target/plugins/$1.zip
    rm -r target/plugins/$1/

    curl https://downloads.wordpress.org/plugin/$1.zip > target/plugins/$1.zip
    unzip target/plugins/$1.zip -d target/plugins
}

install_plugin advanced-custom-fields
install_plugin custom-fields-permalink-redux
