# INFO4345
INFO 4345 - Web Application Security

# *Class Assignment [#01]*

The `index.html` file contains the the HTML forms based on the given assignment task. The file is linked by `styles.css`, `script.js`, and `submit.php`

The `styles.css` is a file to style the HTML design.

The `script.js` file contains the regexes of each HTML form. It also contains the code where if the user inputs something that does not meet the requirement of the defined regexes, it will display an error message in the web page.

The `submit.php` is mainly to retrieve the input texts done by the user in the HTML form, if all the input matches the defined regexes in the `script.js` file.

# *Class Assignment [#02]*

The `register.html` is used to enter email and password for the user. If the user does not match the requirements of the regex, the user my re-enter until it matches. If matches, the details will be passed onto `register.php` to store the details in MySQL. (The hashing function for password is also in the file).

Once registered, the user can login, via `login.html`, the same details, to access `index.html`. If the input is incorrect, the user must re-enter until it is correctly matched with the data stored in MySQL. `login.php` is used to ensure authentication to authorized registered users.

`student_details.php` is used as the session management, where the session ID is tracked to each pages that the user is in
