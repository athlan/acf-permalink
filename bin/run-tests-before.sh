#!/bin/bash

install_plugin() {
    plugin_name=$1
    download_url=$2

    mkdir -p target/plugins

    [ -d "target/plugins/$plugin_name/" ] && return;

    echo "Downloading $plugin_name"
    if [ -z "$download_url" ]; then
        echo "Determining download url"
        plugin_page_html=`curl -s https://wordpress.org/plugins/$plugin_name/`
        download_url=`echo $plugin_page_html | sed -r -e 's/(.*)class="plugin-download([^"]*)" href="([^"]*)"(.*)/\3/'`
        #download_url="https://downloads.wordpress.org/plugin/$plugin_name.zip"
    fi;

    rm target/plugins/$plugin_name.zip
    rm -r target/plugins/$plugin_name/

    echo "Download url is $download_url"
    
    curl -L $download_url > target/plugins/$plugin_name.zip
    unzip target/plugins/$plugin_name.zip -d target/plugins/tmp

    mkdir target/plugins/$plugin_name/
    cp -r target/plugins/tmp/*/* target/plugins/$plugin_name/
    rm -rf target/plugins/tmp
}

install_plugin advanced-custom-fields
install_plugin custom-fields-permalink-redux
