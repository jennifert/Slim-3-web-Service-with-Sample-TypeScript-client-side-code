# Slim 3 web Service with Sample TypeScript client side code
A web service built using slim 3 and the "mnapoli/front-yaml" composer library to search in Yaml tags in a folder _post.

This was an a quick prototype built to see if it can be used as either a quick way to replace my Jekyll site search engine, or create a new site in php, using the existing posts folder from the old site. Also inclused the typescript (working, though not fully tested for accessibility) code that was pulling the serice in.

Decided not to go that route, but thought would upload here if someone else can have an idea for it.

Contents:
_posts/ : folder that contains the jekyll .md or .html files
api/: Slim 3 service
Fetch_lite-accessible.ts: typescript code used in front end to pull posts in
