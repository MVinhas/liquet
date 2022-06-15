# Important Info

liquet is archived and was superseeded by [nifty-cms](https://github.com/MVinhas/nifty)
This was my first "PHP from scratch" experience, and it is usable, but meanwhile I've found better and simpler ways to achieve the same things.
The last release is 0.1.0, from 2022-06-15

# Liquet

liquet was an MVC CMS blog build from scratch, only with Bootstrap as CSS/JS provider and Twig as a template engine. The primary goal has educational intentions, but it is expected to serve the final user as a simple but functional CMS blog to use for whatever purpose

## Installation

You just have to download the project and create a link on your webserver folder. Then, just update the dependencies by updating composer:

```bash
composer update
```
## Directory Structure
```
config/              Website and Database configurations
controllers/         Part of MVC
cpanel/              Admin and User Settings area
engine/              Core website functions
migrations/          Database tables creator
models/              Part of MVC
scripts/             Website JS/jQuery
style/               Website CSS
tests/               Unit Tests
views/               Part of MVC
```

## Contributing
I made this as an open project to share with others my thoughts on how a PHP blog should be done; of course, there are other ways (and probably more efficient) to achieve the same goal, and please, feel free to contribute and share your thoughts with me.

## License
[AGPL-3.0](https://choosealicense.com/licenses/agpl-3.0/)