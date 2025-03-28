
The goal of this module is to create a simple password encryption and verification system.  
This module works with two types of algorithms: Bcrypt (default) and ARGON2I/ARGON2ID.

**Bcrypt**

The Bcrypt algorithm is a hashing algorithm that is widely used and recommended by the security community to store user passwords in a secure way

### Bcrypt truncates Input > 72 bytes


> The input string of the bcrypt algorithm is limited to 72 bytes. If you use a string with a length more than this limit, bcrypt will consider only the first 72 bytes.

We use a class *SamuelPouzet\Crypt\Crypt*


**Constructor :**

> $crypt = new Crypt(iterable $options = [], string $algorithm =_PASSWORD_DEFAULT_)


**options :**

Bcrypt : *cost* (number between 4 and 31)

Argon : *memory_cost*(number), *time_cost* (number), *threads* (number)`



`**Encode :`**

>$crypt->hash(string $plaintext): string


`**Verify**`

>$crypt->verify(string $password, string $hash): bool
