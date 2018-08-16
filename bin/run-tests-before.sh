#!/bin/bash

install_plugin() {
    plugin_name=$1
    download_url=$2

    if [ -z "$download_url" ]; then
        download_url="https://downloads.wordpress.org/plugin/$plugin_name.zip"
    fi;

    mkdir -p target/plugins

    [ -d "target/plugins/$plugin_name/" ] && return;

    rm target/plugins/$plugin_name.zip
    rm -r target/plugins/$plugin_name/

    curl -L $download_url > target/plugins/$plugin_name.zip
    unzip target/plugins/$plugin_name.zip -d target/plugins/tmp

    mkdir target/plugins/$plugin_name/
    cp -r target/plugins/tmp/*/* target/plugins/$plugin_name/
    rm -rf target/plugins/tmp
}

install_plugin advanced-custom-fields
install_plugin custom-fields-permalink-redux https://github.com/athlan/wordpress-custom-fields-permalink-plugin/archive/feature/permalink-attributes.zip
