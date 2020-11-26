# Repo is no longer maintained
This software is no longer maintained. You are welcome to have a look at the current Forks. There you will find nice colleagues who develop this software further.
https://github.com/Elompenta/hashnest-php-api/network/members

# hashnest-php-api
Free Hashnest PHP-API-Client ready to use. (https://www.hashnest.com/)

# Initial Setup

Get files from Github repository

    $ git clone https://github.com/Elompenta/hashnest-php-api.git
    $ cd hashnest-php-api

# Update
    $ cd hashnest-php-api
    $ git pull

# How to use
Include the PHP Class hashnest.php and feel free to communicate with the hashnest API.

    require('hashnest.php');
    $hashnest = new hashnest('Username', 'API-KEY', 'API-SECRET');

_Username must be your Username, NOT your Account Email_

We will deliver a demo.php with lot of demo stuff.
Feel free to code your own nice stuff and put it as demo to this repo

## Methods
You are able to use all official hashnest statements. Just call the API-Client with the statement that you want.
Official API Documentation: https://www.hashnest.com/hashnest_api

- $hashnest->account();
    - Query Account Info
- $hashnest->currency_accounts();
    - Check users account balance
- $hashnest->hash_accounts();
    - Check user's hash rate account balance

All Methods return a JSON decoded PHP Object.  

# Pricacy
- We will NEVER store your API-Secret or send it away within any communication
- All API request are encrypted by TLS

# Current Limitations (we work on it)
- *not all official statements are implemented yet*
