## Mini-Aspire

**Requirements**

The project focuses on creating a mini version of Aspire so that the candidate can think about the systems and architecture the real project would have. The task is defined below:

Build a simple API that allows to handle user loans. Necessary entities will have to be (but not limited to): users, loans, and repayments.
The API should allow simple use cases, which include (but are not limited to): creating a new user, creating a new loan for a user, with different attributes (e.g. duration, repayment frequency, interest rate, arrangement fee, etc.), and allowing a user to make repayments for the loan.

The app logic should figure out and not allow obvious errors. For example a user cannot make a repayment for a loan that’s already been repaid.


## How to Install
First clone the repo to your local machine by the following command-
`
git clone https://github.com/tisuchi/mini-aspire.git
`

Now, cd to **mini-aspire** folder by `cd mini-aspire`. 

Next, run update composer by `composer update` command. 


## Configuration 
Once you have successfully download, you just need to set up your database connection. 
- Open `.env` file and set the following details-
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=set your database name here
DB_USERNAME=database username 
DB_PASSWORD=databae password
```

**Note:** Set your app_key if it is required. To generate the app_key for your application, just run the following command in the terminal-
```
php artisan key:generate
```

- Finally, you need to run the following migration command. 
```
php artisan migrate
```
The above command will crate the necessary tables in your provided database. 



## How to access?
Once you have done all the required configuration, then you can able to access the following api. You may use any kind of api client. In my side, I use (Postman)[https://www.getpostman.com/]. 


## List of Route
Screen Shot 2018-11-21 at 9.13.09 PM

Thank you.
