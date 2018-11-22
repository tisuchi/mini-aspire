## Mini-Aspire

**Requirements**

The project focuses on creating a mini version of Aspire so that the candidate can think about the systems and architecture the real project would have. The task is defined below:

Build a simple API that allows to handle user loans. Necessary entities will have to be (but not limited to): users, loans, and repayments.
The API should allow simple use cases, which include (but are not limited to): creating a new user, creating a new loan for a user, with different attributes (e.g. duration, repayment frequency, interest rate, arrangement fee, etc.), and allowing a user to make repayments for the loan.

The app logic should figure out and not allow obvious errors. For example a user cannot make a repayment for a loan that’s already been repaid.


## How to Install
First of all, clone the repo to your local machine by the following command-
`
git clone https://github.com/tisuchi/mini-aspire.git
`

Now, cd to **mini-aspire** folder by using this command `cd mini-aspire`. 

Next, run update composer `composer update`.


## Configuration 
Once you have successfully downloaded, you just need to set up your database connection. 
- Open `.env` file and set the following details-
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=set your database name here
DB_USERNAME=database username 
DB_PASSWORD=databae password
```

**Note:** Set your `app_key` once it is required. To generate the `app_key`, run the following command in the terminal-
```
php artisan key:generate
```

- Finally, you need to run the migration command. 
```
php artisan migrate
```
The migration command wil create the required tables in your database. 



## How to access?
Once you have done all the required configuration, then you are able to access the following **list of Route**. You may use any kind of api client. I use (Postman)[https://www.getpostman.com/]. 


## List of Route
![list of rout](https://github.com/tisuchi/mini-aspire/blob/master/screenshot/001.png)



Thank you.
