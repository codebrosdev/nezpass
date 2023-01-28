
# NezPass

Allows you to store part of your password profile. Outputs generated passwords just like LessPass.com. 

## Why

Difference is that in this version we store some of the data over a cookie. This means you don't need to keep entering the same options such as master password, uppercase/lowercase/symbols/numbers next time. 

Lesspass.com has recently stopped its database service for saving password profiles, for the reason that it's an extra effort to encrypt user data and also it deviates away from their goal of not having to sync passwords. 

We do not store the site and login used in the database simply because of what happened at [LastPass](https://www.malwarebytes.com/blog/news/2023/01/lastpass-updates-security-notice-with-information-about-a-recent-incident). By not storing these login and site, a hacker would have need to guess where to use the generated password (moreover, you can not generate a password without these anyway).


## Technical side

### What Does the Session ID do?

Everytime a user uses site and generates a password, saving a randomly generated cookie, under `cookie['session_id']`. We retrieve the `cookie['session_id']` on the next page reload, then match that session stored in the database (the latest and first one) to bring up what it had. 


### How does this work?

It sends a request to the server to generate the password using the algorithm provided by your inputs.

Everytime user clicks on "Save Session", the profile form is saved to the database. The email and  master password fields is optional to be saved. 

If any fields changes, the "Save Session" button will re-enable.

The next time the user visits this page, it will match the profile in the database based on the cookie value of `session_id`.  The cookie will expire within a day by default.

### How to contribute

Just ping the author


