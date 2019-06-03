# Webproxy

A website based proxy to make blocked websites available, e.g. if you are behind a web proxy firewall which blocks some websites.

## Description

The Webproxy is a simple PHP application which proxies the requested websites content and displays it. It works like a "reverse proxy". It can be used to access websites, which are e.g. blocked by a firewall or similar. The Webproxy doesn't support all websites and also doesn't support anything else than GET requests. But it can be used to visit static websites or to read blog posts. Most of the urls in the proxied website are replaced, to be opened by the Webproxy too.

## Usage

Call the index.php with the desired url to proxy like this: https://yourMachine.tld/pathToYourWebproxyInstallation/index.php?url=theUrlToProxy.tld/subfolder?querystringsAreAlsoSupported

The website should load like on any other machine, which isn't behind a web proxy/firewall. Some stylesheets or scripts may be missing, but the content should always be available.

## Installation

Simply clone the repository on a machine of your choise and make the index.php accessable through a webserver like apache or nginx.

Make sure to also have php and the curl mod installed and active.

## License

This project is licensed under the MIT License - see the [LICENSE](https://github.com/MarvinKlar/Webproxy/blob/master/LICENSE) file for more details.

## Final words

I hope you enjoy using the Webproxy. Feel free to improve, share and fork this project! Thank you!
