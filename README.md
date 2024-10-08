# Database Searcher (DBS)[MySQL]
Basic Web-Development PHP tool to search for a string in your **MySQL/MariaDB** database.

Project is intended for large database users who desires a fast way to find their specific search in a database.

> This is **only** meant to be running on localhost, as it is not safe from SQLi if accessed & configured on a public http.

## Preview
![Alt text](https://i.imgur.com/qmgMKOy.png)


### Usage Scenarios (Real life Events)

> A site got hacked, and I needed to see if there's backdoors inside the database!

> I started a new job, it has a huge database archistructure and I use this tool to find where specific data is stored

> I needed to see if, and where, my webapplication inserted correct data

> I'm using a database schema that i'm unfamiliar with, this tool helped me find what I was looking for easily!

> _--**Your** scenario can be written here, make a **pull request**!--_

## Setup

### This is meant to ONLY be runned on your local environment, read below.

Clone/Download the repository and extract the files in your webserver www directory.
Upon first visit you'll be prompted to fill in database credentials, and that's it!

It's **highly** recommended to **never** use this project in a release as it is **not** safe from SQL Injections.

> SQL Injections can destroy your whole server/website!

# Thank You!
> "What am i living for, if not for you?" - Johnny Preston

## License

[GPL-3.0](LICENSE) © [PatricNox](https://PatricNox.info)
