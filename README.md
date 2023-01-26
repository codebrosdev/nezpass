
# NezPass

Allows you to store your LessPass.com password profile. 

## Why

Unfortunately lesspass.com has stopped its database service for saving password profiles, for the reason that it's an extra effort to encrypt user data.

### What Does the Session ID do?

Everytime a user uses site, saving a randomly generated cookie, under `cookie['session_id']`; 
we retrieve `cookie['session_id']` and then match that with the one in the database to set the profile up.

### How does this work?

It sends a request to the server to generate the password using the algorithm provided by your inputs.

Everytime user clicks on "Save Session", the profile form is saved to the database. The email and  master password fields is optional to be saved. 

If any fields changes, the "Save Session" button will re-enable.

The next time the user visits this page, it will match the profile in the database based on the cookie value of `session_id`.  The cookie will expire within a day by default.

### How to contribute

Just ping the author


