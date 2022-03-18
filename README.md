# Sample Jekyll Web Service - PHP Search Posts
A web service built using slim 3 and the "mnapoli/front-yaml" composer library to search in Yaml tags in a folder _post.

This was built as a quick prototype built to see if it used as a part of the site if I ended up redoing in PHP. Decided not to go that route, but thought someone else may have a use for it.

Also included is the typescript code that was pulling the service in. It has some basic accessibility, but not fully tested.

Contents:
- _posts/ : folder that contains the jekyll .md or .html files
- api/: Slim 3 service
- Fetch_lite-accessible.ts: typescript code used in front end to pull posts in

Requirements:
- PHP 7.1 (untested on higher versions, though should work).
- if you use typescript, an NPM Build (or other) script to run 'tsc' command.
