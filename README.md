[![Build Status](https://travis-ci.com/MVinhas/Seamus.svg?branch=master)](https://travis-ci.com/MVinhas/Seamus)
# Seamus

Seamus is a MVC CMS blog build from scratch, only with Bootstrap as CSS/JS provider and Twig as a template engine. The primarly goal has educational intentions, but it is expected to serve the final user as a simple but functional CMS blog to use for whatever purpose (mine is to talk about music, by the way)

## Installation

You just have to download the project and create a link on your web server folder. Then, just update the dependencies by updating composer:

```bash
composer update
```
## Directory Structure
```
config/              Website and Database configurations
controllers/         Part of MVC
engine/              Core website functions
migrations/          Database tables creator
models/              Part of MVC
scripts/             Website JS/jQuery
style/               Website CSS
tests/               Unit Tests
views/               Part of MVC
cpanel/              Admin and User Settings area
```

## Contributing
I made this as a open project to share with others my thoughts of how a PHP blog should be done; of course there is other ways (and probably more efficient) to achieve the same goal but please, feel free to contribute and share your thoughts with me.

## License
[AGPL-3.0](https://choosealicense.com/licenses/agpl-3.0/)