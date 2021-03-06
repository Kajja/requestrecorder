kajja/requestrecorder
=====================

[![Build Status](https://travis-ci.org/Kajja/requestrecorder.svg?branch=master)](https://travis-ci.org/Kajja/requestrecorder)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Kajja/requestrecorder/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Kajja/requestrecorder/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Kajja/requestrecorder/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Kajja/requestrecorder/?branch=master)

This is a small PHP module to save HTTP request information in a database and to display the saved HTTP request information.

Currently, the only information that is saved are:
* The requested URI
* The request method
* Datetime for the request
* Session id, to be able to link a request to a session

The module also includes a presentation part that formats the HTTP-request records in the database to HTML, for simple integration into a web project.

There is a special adaptation to the Anax-MVC framework that can be used if you prefer it, see the Usage_with_Anax-MVC documentation.

By Mikael Feuk.

License
-------
MIT

History
-------
v 0.5 (2014-11-26)