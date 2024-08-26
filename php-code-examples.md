# PHP Syntax and Code Examples:

## Working with Commenting code

Commenting code is an important practice in programming, allowing developers to annotate code sections for readability and maintainability. PHP supports single-line comments, multi-line comments, and documentation comments. Here are three examples illustrating each type:

### Single-Line Comments

Single-line comments in PHP are made using either `//` or `#.` Anything following these symbols on the same line is treated as a comment and is not executed.

**Example using `//`:**

 ```php
  // This is a single-line comment
  echo "Hello, World!"; // This part of the line is a comment
 ```

**Example using `#`:**

 ```php
  # This is also a single-line comment
  echo "Hello, World!"; # This part of the line is a comment
 ```

### Multi-Line Comments

Multi-line comments are used to comment out blocks of code. They start with `/*` and end with `*/`. Everything in between is considered a comment.

 ```php
  /* This is a multi-line comment
     and it spans multiple
     lines. */
  echo "This is not a comment.";
 ```

This method is commonly used for temporarily disabling a block of code or providing detailed descriptions spanning multiple lines.

### Documentation Comments

Documentation comments (or "DocComments") are a special type of comment used for generating API documentation and structured in a way that documentation generation tools can parse. They start with `/**` and end with `*/`. Inside, you often find annotations in a specific format.

 ```php
  /**
   * Function to greet a user
   *
   * @param string $name The name of the user
   * @return void
   */
  function greet($name) {
      echo "Hello, " . $name . "!";
  }
 ```

DocComments are particularly useful in large projects and frameworks where automated documentation generation becomes crucial to workflow.

##  Working with Basic data types:

PHP data types are not explicitly declared; they are determined at runtime based on the context. In other words, PHP is a *Dynamically Typed Language*.

- **Boolean (bool)**: Represents true or false.
- **Integer (int)**: A whole number.
- **Floating Point Number (float)**: A number with decimals.
- **String**: A sequence of characters.
- **Array**: A collection of key-value pairs in a specific order.
- **Object**: An entity created from a predefined class.
- **NULL**: A variable without any value.

There are multiple methods to identify a variable's type.

**Identifying Type and Value**

- **Using var_dump()**: This function displays a variable's type and value.

  Example:
  ```php
   $text = "PHP";
   var_dump($text);
   // Output: string(3) "PHP"
  ```

**Type Checking Functions**

PHP provides specific functions to check a variable's type:

- `is_bool($value)`: Checks if the value is a boolean.
- `is_int($value)`: Verifies if the value is an integer (also `is_integer()`).
- `is_float($value)`: Determines if the value is a floating-point number.
- `is_string($value)`: Confirms if the value is a string.
- `is_array($value)`: Checks if the value is an array.
- `is_object($value)`: Asserts if the value is an object.
- `is_null($value)`: Determines if the value is NULL.

## Working with Variables

Creating and using variables in PHP is a fundamental part of programming in this language. Variables in PHP are used to store data, like strings, integers, arrays, etc., and they start with a `$` sign. Here are three examples that illustrate different ways of creating and using variables in PHP:

**Example 1: Working with variables**

   ```php
    /* In this example, a string variable `$name` is created and assigned the value 
    `"John Doe"` It's then concatenated with another string and displayed. */

    // Creating a string variable
    $name = "John Doe";

    // Using the variable
    echo "Hello, my name is " . $name;
    // Outputs: Hello, my name is John Doe
   ```

**Example 2: Performing Mathematical Operations with Integer Variables**

   ```php
    /* Here, two integer variables `$number1` and `$number2` are created.
    A third variable `$sum` is used to store the result of their addition.
    The result is then displayed.*/

    // Creating integer variables
    $number1 = 10;
    $number2 = 20;

    // Performing a mathematical operation
    $sum = $number1 + $number2;

    // Using the variable
    echo "The sum of " . $number1 . " and " . $number2 . " is " . $sum;
    // Outputs: The sum of 10 and 20 is 30
   ```

**Example 3: Using Arrays**

   ```php
    /* In this example, an array variable `$colors` is created with three elements.
    Individual elements of the array are accessed using their index and displayed. */

    // Creating an array variable
    $colors = array("Red", "Green", "Blue");

    // Using the array
    echo "The first color is " . $colors[0] . ", and the third color is " . $colors[2];
    // Outputs: The first color is Red, and the third color is Blue
   ```

## Working with assignment operators:

Assignment operators in PHP are used to write a value to a variable. The basic assignment operator is `=`, but several others combine assignment with arithmetic or string operations. Let's go through some examples to illustrate these operators:

**Assignment Operator `=`**

The `=` operator assigns the value on the right to the variable on the left.

  ```php
   $number = 10; // Assigns 10 to $number
   $text = "Hello, PHP!"; // Assigns the string "Hello, PHP!" to $text
  ```

**Arithmetic Assignment Operators**

These operators combine arithmetic operations with assignments.

**Addition Assignment `+=`**

Adds the right-hand operand to the left-hand operand and assigns the result to the left-hand operand.

  ```php
   $a = 10;
   $a += 5; // Equivalent to $a = $a + 5; Now $a is 15
  ```

**Subtraction Assignment `-=`**

Subtracts the right-hand operand from the left-hand operand and assigns the result to the left-hand operand.

  ```php
   $a = 10;
   $a -= 5; // Equivalent to $a = $a - 5; Now $a is 5
  ```

**Multiplication Assignment `*=`**

Multiplies the right-hand operand with the left-hand operand and assigns the result to the left-hand operand.

  ```php
   $a = 10;
   $a *= 2; // Equivalent to $a = $a * 2; Now $a is 20
  ```

**Division Assignment `/=`**

Divides the left-hand operand by the right-hand operand and assigns the result to the left-hand operand.

  ```php
   $a = 10;
   $a /= 2; // Equivalent to $a = $a / 2; Now $a is 5
  ```

**Modulus Assignment `%=`**

Takes modulus using two operands and assigns the result to the left-hand operand.

  ```php
   $a = 10;
   $a %= 3; // Equivalent to $a = $a % 3; Now $a is 1
  ```

**String Concatenation Assignment Operator `.=`**

Concatenates the right-hand operand to the left-hand operand and assigns the result to the left-hand operand.

  ```php
   $text = "Hello, ";
   $text .= "World!"; // Equivalent to $text = $text . "World!"; Now $text is "Hello, World!"
  ```

## Working with Comparison operators

Comparison operators in PHP compare two values (numbers or strings) against each other. These operators are essential for controlling the flow of the program through conditional statements like `if`. Let's look at some of the basic comparison operators in PHP, along with examples:

**Equal `==`**

Checks if two values are equal. It returns `true` if the values are equal and `false` otherwise.

  ```php
   if (3 == "3") {
       echo "Yes, they are equal."; // This will be executed
   }
  ```

Here, `3` (an integer) and `"3"` (a string) are considered equal because `==` compares only the values, not the types.

**Identical `===`**

Checks if two values are equal and of the same type. It returns `true` only if the value and the type are the same.

  ```php
   if (3 === "3") {
       echo "Yes, they are identical.";
   } else {
       echo "No, they are not identical."; // This will be executed
   }
  ```

In this case, although `3` and `"3"` have the same value, they are of different types (integer and string), so they are not identical.

**Not Equal `!=`**

Checks if the two values are not equal. It returns `true` if the values are unequal and `false` otherwise.

  ```php
   if (3 != 4) {
       echo "Yes, they are not equal."; // This will be executed
   }
  ```

Here, `3` and `4` are different values, so the condition is true.

**Not Identical `!==`**

Checks if two values are not equal or not of the same type.

  ```php
   if (3 !== "3") {
       echo "Yes, they are not identical."; // This will be executed
   }
  ```

In this case, `3` (integer) and `"3"` (string) are considered not identical because they are of different types.

**Greater Than `>`**

Checks if the value on the left is greater than the value on the right.

  ```php
   if (5 > 3) {
       echo "Yes, 5 is greater than 3."; // This will be executed
   }
  ```

**Less Than `<`**

Checks if the value on the left is less than the value on the right.

  ```php
   if (2 < 3) {
       echo "Yes, 2 is less than 3."; // This will be executed
   }
  ```

**Greater Than or Equal To `>=`**

Checks if the value on the left is greater than or equal to the value on the right.

  ```php
   if (5 >= 5) {
       echo "Yes, 5 is greater than or equal to 5."; // This will be executed
   }
  ```

**Less Than or Equal To `<=`**

Checks if the value on the left is less than or equal to the value on the right.

  ```php
   if (3 <= 5) {
       echo "Yes, 3 is less than or equal to 5."; // This will be executed
   }
  ```

## Working with Logical Operators

Logical operators in PHP are used to combine conditional statements. They are essential for making decisions based on multiple conditions. Here's a basic example of how to create and work with logical operators in PHP:

### Creating and Using Logical Operators

**AND Operator (`&&` or `and`)**

The `&&` operator returns `true` if both operands are `true`. It's useful for combining multiple conditions that must all be true for the combined condition to be true.

```php
 $age = 25;
 $isEmployed = true;
 
 if ($age > 18 && $isEmployed) {
     echo "Eligible for the loan.";
 } else {
     echo "Not eligible for the loan.";
 }
 // Outputs: Eligible for the loan.
```

In this example, the loan eligibility requires both conditions (`$age > 18` and `$isEmployed`) to be true.

**OR Operator (`||` or `or`)**

The `||` operator returns `true` if at least one of the operands is `true`. It's used when only one of multiple conditions needs to be true for the combined condition to be true.

```php
 $hasValidID = false;
 $hasPassport = true;
 
 if ($hasValidID || $hasPassport) {
     echo "Eligible for entry.";
 } else {
     echo "Not eligible for entry.";
 }
 // Outputs: Eligible for entry.
```

In this case, having a valid ID or a passport is enough for eligibility.

**NOT Operator (`!`)**

The `!` operator inverts the value of its operand. If the operand is `true`, it returns `false`, and if it is `false`, it returns `true`.

```php
 $isRaining = false;
 
 if (!$isRaining) {
     echo "You can leave your umbrella at home.";
 } else {
     echo "Don't forget your umbrella.";
 }
 // Outputs: You can leave your umbrella at home.
```

This example checks if it is not raining to decide whether an umbrella is needed.

**XOR Operator (`xor`)**

The `xor` operator returns `true` if either operand is `true`, but not both. It's less common than the other logical operators but useful in certain situations.

```php
 $hasCar = true;
 $hasBike = false;
 
 if ($hasCar xor $hasBike) {
     echo "You have one mode of transport.";
 } else {
     echo "You either have both or none.";
 }
 // Outputs: You have one mode of transport.
```

The condition is true in this example because only one of the two conditions (`$hasCar` and `$hasBike`) is true.

These examples demonstrate using logical operators in PHP to create complex conditions by combining simple conditional statements. Logical operators are crucial in decision-making processes in programming.

## Working with Strings

Working with strings is fundamental to any programming language, including PHP. Strings are used to store and manipulate text. Here's a basic example of creating a string variable in PHP and performing some common operations with it:

### Creating a String Variable

```php
 // Creating a string variable
 $greeting = "Hello, World!";
```

In this example, `$greeting` is a string variable that holds the text `"Hello, World!"`.

### Basic String Operations

**Concatenation** - Joining strings together:
   ```php
    $firstName = "John";
    $lastName = "Doe";
    $fullName = $firstName . " " . $lastName; // Outputs: John Doe
   ```

**String Length** - Getting the length of a string:
   ```php
    $length = strlen($greeting); // Outputs: 13
   ```

**String Replacement** - Replacing part of a string with another string:
   ```php
    $newGreeting = str_replace("World", "PHP", $greeting); // Outputs: Hello, PHP!
   ```

**String Case Conversion** - Converting a string to upper or lower case:
   ```php
    $upperCase = strtoupper($greeting); // Outputs: HELLO, WORLD!
    $lowerCase = strtolower($greeting); // Outputs: hello, world!
   ```

**Substring Extraction** - Extracting a part of a string:
   ```php
    $subString = substr($greeting, 7, 5); // Outputs: World
   ```

In this example, `$greeting` demonstrates various string operations like concatenation, finding the length, replacing text within the string, changing the case, and extracting a substring. These operations are common in PHP programming, especially when dealing with text processing and manipulation.

### More about String Concatenation

String concatenation in PHP is joining one or more strings together. PHP uses the dot `.` operator for concatenation. You can concatenate strings enclosed in single quotes `' '` or double quotes `" "`. Here are three examples demonstrating these concepts:

**Concatenation with Single Quotes**

Using single quotes `' '` for string literals:

  ```php
   /* In this example, two string variables `$firstName` and `$lastName` are concatenated with a space in between, using single quotes. */

   $firstName = 'John';
   $lastName = 'Doe';

   // Concatenation with single quotes
   $fullName = $firstName . ' ' . $lastName;

   echo $fullName;
   // Outputs: John Doe
  ```

**Concatenation with Double Quotes**

Using double quotes `" "` allows for variable interpolation:

  ```php
   /* Here, `$city` and `$country` are enclosed in double quotes. PHP automatically interpolates the variables within the string. */

   $city = "New York";
   $country = "USA";

   // Concatenation with double quotes
   $location = "$city, $country";

   echo $location;
   // Outputs: New York, USA
  ```

## Working with Numbers

Working with numbers is a fundamental aspect of programming in PHP, as in most programming languages. PHP supports different numbers, including integers and floating-point numbers (or doubles). Here's a basic example of creating number variables in PHP and performing some common operations with them:

### Creating Number Variables

```php
 // Creating integer and floating-point number variables
 $integerNumber = 10;
 $floatingNumber = 20.5;
```

In this example, `$integerNumber` is an integer variable that holds the value `10`, and `$floatingNumber` is a floating-point number that holds the value `20.5`.

**Basic Number Operations**

**Arithmetic Operations** - Performing calculations like addition, subtraction, multiplication, and division:
   ```php
    $sum = $integerNumber + $floatingNumber; // Addition, Outputs: 30.5
    $difference = $floatingNumber - $integerNumber; // Subtraction, Outputs: 10.5
    $product = $integerNumber * 2; // Multiplication, Outputs: 20
    $quotient = $floatingNumber / $integerNumber; // Division, Outputs: 2.05
   ```

**Increment and Decrement** - Increasing or decreasing a number by one:
   ```php
    $integerNumber++; // Increment, $integerNumber is now 11
    $integerNumber--; // Decrement, $integerNumber is back to 10
   ```

**Rounding Numbers** - Rounding floating-point numbers:
   ```php
    $roundedNumber = round($floatingNumber); // Round to nearest whole number, Outputs: 21
    $floorNumber = floor($floatingNumber); // Round down, Outputs: 20
    $ceilNumber = ceil($floatingNumber); // Round up, Outputs: 21
   ```

**Working with Random Numbers** - Generating random numbers:
   ```php
    $randomNumber = rand(1, 100); // Random number between 1 and 100
   ```

In these examples, `$integerNumber` and `$floatingNumber` demonstrate various operations like arithmetic calculations, incrementing/decrementing, rounding, and generating random numbers. These operations are commonly used in PHP programming for handling numerical data and calculations.

## Working with Arrays

Arrays in PHP store multiple values in a single variable, making them extremely useful for handling data collections. Here’s a basic example of creating an array in PHP and performing some common operations with it:

### Creating an Array

```php
 // Creating an array
 $fruits = array("Apple", "Banana", "Cherry");
```

In this example, `$fruits` is an array that contains three elements: "Apple", "Banana", and "Cherry".

### Basic Array Operations

**Accessing Array Elements** - Getting a value from an array by its index:
   ```php
    echo $fruits[0]; // Outputs: Apple
   ```

**Adding Elements to an Array** - Appending elements to an array:
   ```php
    $fruits[] = "Durian"; // Adds "Durian" to the end of the array
   ```

**Counting Elements in an Array** - Finding out how many elements an array contains:
   ```php
    $numberOfFruits = count($fruits); // Outputs: 4
   ```

**Iterating Over an Array** - Using a loop to go through each element in the array:
   ```php
    foreach ($fruits as $fruit) {
        echo $fruit . "<br>";
    }
    // This will output:
    // Apple
    // Banana
    // Cherry
    // Durian
   ```

**Modifying Array Elements** - Changing the value of an array element:
   ```php
    $fruits[1] = "Blueberry"; // Changes "Banana" to "Blueberry"
   ```

**Sorting Arrays** - Sorting the elements of an array:
   ```php
    sort($fruits); // Sorts the array in alphabetical order
   ```

**Associative Arrays** - Creating and using an associative array (with named keys):
   ```php
    $ages = array("Peter" => 20, "John" => 30, "Mary" => 25);
    echo "Age of John is " . $ages["John"]; // Outputs: Age of John is 30
   ```

In these examples, `$fruits` and `$ages` demonstrate how arrays can be created, accessed, modified, and iterated in PHP. Arrays are a fundamental part of PHP programming and are used for various tasks, including collecting data sets, passing multiple parameters to functions, and much more.

## Working with Dates

The `date()` function in PHP is used to format a local date and time, and it is beneficial for all kinds of date-related operations. Here are three common examples of working with the `date()` function in PHP:

**Example 1: Displaying the Current Date**

You can use the `date()` function to display the current date in a specific format. Here's how to display the date in the format of year-month-day (YYYY-MM-DD):

  ```php
   // Displaying the current date in YYYY-MM-DD format
   $currentDate = date("Y-m-d");
   echo "Today's date is: " . $currentDate;
   // Might output: Today's date is: 2024-01-06
  ```

**Example 2: Displaying the Current Time**

The `date()` function can also format the current time. Here's an example of how to display the current time in the format of hours:minutes:seconds (HH:MM:SS):

  ```php
   // Displaying the current time in HH:MM:SS format
   $currentTime = date("H:i:s");
   echo "Current time is: " . $currentTime;
   // Might output: Current time is: 15:30:45
  ```

**Example 3: Formatting a Specific Timestamp**

If you have a specific timestamp, you can format it using the `date()` function. This is useful for converting timestamps into more readable date formats. Here's an example:

  ```php
   /* In this example, we're formatting a Unix timestamp into a more readable string, including the month name, day, year, and time. */
   // A specific timestamp
   $timestamp = 1672915200; // Represents 2023-01-05 00:00:00
   
   // Formatting the timestamp into a readable date
   $formattedDate = date("F j, Y, g:i a", $timestamp);
   echo "Formatted date: " . $formattedDate;
   // Might output: Formatted date: January 5, 2023, 12:00 am
  ```

## Working with Control Statements

Control statements are crucial to any programming language, including PHP, as they allow you to perform various actions based on different conditions. Here are three examples demonstrating the use of `if`, `if-else`, and `if-elseif-else` in PHP:

**Using `if` Statement**

The `if` statement executes a code block only if a specified condition is true.

   ```php
    /* In this example, the message "It's warm outside!" is printed only if `$temperature` is greater than 25. */

    $temperature = 30;

    // Simple if statement
    if ($temperature > 25) {
        echo "It's warm outside!";
    }
    // Outputs: It's warm outside!
   ```

**Using `if-else` Statement**

The `if-else` statement executes one block of code if a condition is true and another if the condition is false.

   ```php
    /* Here, the code checks if `$age` is 18 or more. If true, it prints, "You are an adult."; otherwise, it prints "You are a minor." */
    $age = 18;

    // if-else statement
    if ($age >= 18) {
        echo "You are an adult.";
    } else {
        echo "You are a minor.";
    }
    // Outputs: You are an adult.
   ```

**Using `if-elseif-else` Statement**

The `if-elseif-else` statement is used to specify several conditions to check, executing different blocks of code for each condition.

   ```php
    /* In this example, the code checks the `$score` variable against multiple conditions to determine and print a grade. */

    $score = 75;

    // if-elseif-else statement
    if ($score >= 90) {
        echo "Grade: A";
    } elseif ($score >= 80) {
        echo "Grade: B";
    } elseif ($score >= 70) {
        echo "Grade: C";
    } else {
        echo "Grade: F";
    }
    // Outputs: Grade: C
    ?>
   ```

##  Working with alternative syntax for control structures

Make your templates cleaner and more readable by mixing PHP and HTML. A basic example demonstrates this syntax with an `if-elseif-else` statement to conditionally render HTML content based on a condition.

### Example: Displaying Different Greetings Based on the Time of Day

```php
<?php $time = date("H"); ?>

<?php if ($time < 12) : ?>
    <div>Good morning!</div>
<?php elseif ($time < 18) : ?>
    <div>Good afternoon!</div>
<?php else : ?>
    <div>Good evening!</div>
<?php endif; ?>
```

### Explanation:

- The `<?php $time = date("H"); ?>` line gets the current hour in 24-hour format. The `date("H")` function returns the hour of the day from `00` to `23`.
- The first condition `<?php if ($time < 12) : ?>` checks if the current time is before noon. If true, it displays "Good morning!".
- The `<?php elseif ($time < 18) : ?>` line adds a condition to check if the time is before 18 (6 PM). If the time is between noon and 6 PM, it displays "Good afternoon!".
- The `<?php else : ?>` provides a final alternative that displays "Good evening!" if the time is 6 PM or later.
- The `<?php endif; ?>` ends the conditional block.

This example demonstrates how you can manage multiple conditions in PHP using the alternative syntax, which is especially handy when integrating PHP logic with HTML content.

##  Working with the Ternary Operator

   The ternary operator in PHP is a shorthand for the `if-else` statement.
   It is used to execute different code based on the evaluation of a condition.
   The syntax of the ternary operator is:
    
      `condition ? exprIfTrue : exprIfFalse;`

**Basic Usage**:
   ```php
   //In this example, `$isAdult` will be `"Yes"` if `$age` is greater than or equal to 18, and `"No"` otherwise.
   $age = 20;
   $isAdult = ($age >= 18) ? "Yes" : "No";
   echo $isAdult; // Outputs: Yes
   ```

**Nested Ternary**:
   ```php
   //Here, we use a nested ternary operator to determine a grade based on the score. If `$score` is 90 or above, `$grade` is "A". If it's between 80 and 89, `$grade` is "B". Otherwise, it's "C".
   $score = 85;
   $grade = ($score >= 90) ? "A" : (($score >= 80) ? "B" : "C");
   echo $grade; // Outputs: B
   ```

**Using Ternary with Functions**:
   ```php
   //In this example, if `$user` is "Alice", it calls the `greet` function with `$user` as a parameter. If `$user` is not "Alice", it outputs "Unknown user".
   $user = "Alice";
   echo ($user === "Alice") ? greet($user) : "Unknown user";

   function greet($name) {
       return "Hello, " . $name;
   }
   // Outputs: Hello, Alice
   ```

## Working with the Switch statement

PHP's `switch` statement performs different actions based on different conditions. It's similar to a series of `if` statements but is often more concise and easier to read, particularly when you have several different conditions to check against the same value. Here's an example of a `switch` statement:

**Example: `switch` Statement to Display a Weekday**

Suppose you want to display the name of a weekday based on a numeric input (where `1` is Monday, `2` is Tuesday, and so on).

```php
 $dayNumber = 4;
 
 switch ($dayNumber) {
     case 1:
         echo "Monday";
         break;
     case 2:
         echo "Tuesday";
         break;
     case 3:
         echo "Wednesday";
         break;
     case 4:
         echo "Thursday"; // This will be executed
         break;
     case 5:
         echo "Friday";
         break;
     case 6:
         echo "Saturday";
         break;
     case 7:
         echo "Sunday";
         break;
     default:
         echo "Invalid day number";
 }
```

In this example, the `switch` statement is used to check the value of `$dayNumber`. Each `case` represents a possible value of `$dayNumber`, and the corresponding code block is executed if `$dayNumber` matches that case. The `break` statement prevents the code from running into the next case accidentally. The `default` case is executed if none of the cases match the value of `$dayNumber`. In this scenario, since `$dayNumber` is `4`, the output will be `"Thursday"`.

## Working with the `header()` function

In PHP, a page redirect can be performed using the `header()` function, which sends a raw HTTP header to the client. For a redirect, you would typically use the `Location` header. However, when using PHP's syntax in a document primarily composed of HTML, it's important to remember that any attempt to send headers must be done before any output is sent to the browser, including whitespace or HTML. A redirect should always be placed before any HTML tags.

Here's an example of how you might structure a file with a conditional redirect with PHP at the top and HTML content below.

### Example: Conditional Redirect in PHP

```php
<?php
// Determine the condition for the redirect
$loggedIn = false;

// Perform the redirect based on the condition
if (!$loggedIn) {
    header('Location: login.php');
    exit; // Ensure the script stops executing after the redirect
}

// Note: No HTML or whitespace before this PHP tag
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
</head>
<body>
    <div>Welcome, you are logged in.</div>
</body>
</html>
```

### Explanation:

- The PHP block at the top checks if a user is logged in by evaluating the `$loggedIn` variable.
- If `$loggedIn` is `false`, the script sends a `Location` header, redirecting the user to `login.php`. It's crucial to call `exit;` after `header('Location: ...');` to stop the execution of the script immediately after the redirect.
- The HTML content is only displayed if the user is logged in (`$loggedIn` is `true`), because the script execution would have stopped before reaching the HTML if the user was not logged in.
- This setup ensures that the header function call to perform the redirect occurs before any HTML output, adhering to PHP's requirement that headers must be sent before output.

Remember, for redirects and any other header manipulations in PHP, always place such code at the beginning of your file before any output (including whitespace and HTML tags) to avoid "headers already sent" errors.

## Working with `include` and `require` statements

PHP's `include` and `require` statements are used to insert the contents of one PHP file into another PHP file before the server executes it. They are widely used to maintain clean, modular, and reusable code. Here's a basic example of how to use these statements:

Suppose you have two PHP files: `header.php` and `footer.php`.

**header.php:**

```php
<!DOCTYPE html>
<html>
<head>
    <title>My Web Page</title>
</head>
<body>
    <header>
        <h1>Welcome to My Web Page</h1>
    </header>
```

**footer.php:**

```php
    <footer>
        <p>Footer content here</p>
    </footer>
</body>
</html>
```

### Main File with `include`

Now, you can create a main PHP file, say `index.php`, where you `include` these files.

**index.php:**

```php
<?php
include 'header.php';
?>

    <div>
        <p>Main content of the web page here...</p>
    </div>

<?php
include 'footer.php';
?>
```

### Using `require`

The `require` statement works similarly to `include`, but with one key difference: if the file to be included/required is not found, `require` will cause a fatal error and halt script execution, while `include` will only emit a warning (E_WARNING) and the script will continue.

**index.php** using `require`:

```php
<?php
require 'header.php';
?>

    <div>
        <p>Main content of the web page here...</p>
    </div>

<?php
require 'footer.php';
?>
```

### `include_once` and `require_once`

Additionally, you have `include_once` and `require_once`, which are similar to `include` and `require`, respectively. The difference is that if the file has already been included, it will not be included (or required) again.

### Summary

- Use `include` or `require` when reusing code like headers, footers, or common functions across multiple pages.
- Choose between `include` and `require` based on how you want your script to handle the absence of the included file. Use `require` if the file is essential for running the application.
- `include_once` and `require_once` ensure a file is included only once, even if it's called multiple times.

These structures support creating modular, maintainable, and cleaner code in PHP applications.

## Working with Database Connectivity

**Use PDO to connect to a database, then use a try/catch to test the connection**
   ```php
    function pdo_connect_mariadb()
    {
        $servername = "localhost";
        $dbname = "database";
        $username = "username";
        $password = "password";

        try {
            return new PDO(
                'mysql:host=' . $servername .
                    ';dbname=' . $dbname .
                    ';charset=utf8',
                $username,
                $password
            );
        } catch (PDOException $exception) {
            die("PDO failed to connect to the database: $exception");
        }
    }
   ```
**Create a PDO databse connection object by calling a function**
   ```php
    $pdo = pdo_connect_mariadb();
   ```

## Working with Database CRUD operations

**Create (INSERT)**
   ```php
    //In this example, `'value1'` and `'value2'` are the values to be inserted into `column1` and `column2` respectively.
    $sql = "INSERT INTO table_name (column1, column2) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['value1', 'value2']);
   ```
**Read (SELECT)**
   ```php
    //Here, `'value1'` is the value used in the WHERE clause to filter results from `table_name`.
    $sql = "SELECT * FROM table_name WHERE column1 = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['value1']);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //A foreach loop is used to access each row returned
    foreach ($results as $row) {
        // process each row
    }
   ```
**Update**
   ```php
    //In this case, `column1` is updated to `'newValue1'` where `column2` equals `'value2'`.
    $sql = "UPDATE table_name SET column1 = ? WHERE column2 = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['newValue1', 'value2']);
   ```
**Delete**
   ```php
    //This deletes rows from `table_name` where `column1` equals `'value1'`.
    $sql = "DELETE FROM table_name WHERE column1 = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['value1']);
   ```

## Working with blending PHP and HTML to display records

Using `foreach` syntax in PHP, which utilizes a colon `:` and `endforeach;`, can make the code more readable, especially in templates or embedded HTML. Here are the same three examples of outputting data from a PDO recordset, reformatted using this style:

**Output in HTML Text Format**

Displaying each record's information in plain HTML text format:

 ```php
  <?php foreach ($records as $record) : ?>
      Name: <?php echo $record['name']; ?>, Email: <?php echo $record['email']; ?><br>
  <?php endforeach; ?>
 ```

**Output in an HTML Table**

Creating a table to present the data in a structured format:

 ```php
  <table border="1">
      <tr>
          <th>Name</th>
          <th>Email</th>
      </tr>
      <?php foreach ($records as $record) : ?>
          <tr>
              <td><?php echo $record['name']; ?></td>
              <td><?php echo $record['email']; ?></td>
          </tr>
      <?php endforeach; ?>
  </table>
 ```

Each user's name and email are displayed in separate table rows in this example.

**Output in an HTML List**

Using an unordered list to display each record:

 ```php
  <ul>
      <?php foreach ($records as $record) : ?>
          <li>Name: <?php echo $record['name']; ?>, Email: <?php echo $record['email']; ?></li>
      <?php endforeach; ?>
  </ul>
 ```

This code creates an unordered list where each user's name and email are shown as list items.

---

In these examples, `$records` represents the PDO recordset obtained from a database query. The `foreach` loop iterates over each row in the recordset, and the data is inserted into HTML elements for display. The exact structure of `$record` (`$record['name']`, `$record['email']`) depends on the columns returned by your SQL query.

## Working with other Database Operations

**Retrieve Number of Affected Rows**
   ```php
    $affectedRows = $stmt->rowCount();
    echo $affectedRows;
   ```
**Get the ID for the last record inserted**
   ```php
    $lastId = $pdo->lastInsertId();
   ```
**Close Query and Database Connection**
   ```txt
    PDO and prepared statements do not require explicit closing.
    They are closed automatically when the variable is no longer in use.
   ```

## Working with GET and POST Requests
**Check if the $_GET Request Variable Exists**
   ```php
    if (isset($_GET['param'])) {
        // Do something
    }
   ```

**Check if the $_POST Variable Exists**
   ```php
    if (isset($_POST['param'])) {
        // Do something
    }
   ```

## Working with HTML Forms

Creating and working with HTML forms is a fundamental aspect of web development. Forms collect user input, which can be processed by a server-side language like PHP. Here's a basic example of an HTML form and how to handle the form data with PHP:

### HTML Form

First, we'll create a simple HTML form that asks for the user's name and email address. The form data will be sent to the same script (`form.php`) for processing.

Create a file named `form.php` and start with the following HTML form:

```html
 <!DOCTYPE html>
 <html>
 <head>
     <title>Simple Form</title>
 </head>
 <body>
 
     <form action="form.php" method="post">
         Name: <input type="text" name="name"><br>
         Email: <input type="email" name="email"><br>
         <input type="submit" value="Submit">
     </form>
 
 </body>
 </html>
```

### PHP Script to Handle the Form

At the top of the same file (`form.php`), add the PHP script to process the form data when the form is submitted:

```php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Collect value of input field
     $name = $_POST['name'];
     $email = $_POST['email'];
 
     if (empty($name) || empty($email)) {
         echo "Name and email are required.";
     } else {
         echo "Hello " . htmlspecialchars($name) . "! ";
         echo "Your email address is: " . htmlspecialchars($email);
     }
 }
```

**How It Works:**

- The form's `action` attribute points to `form.php`, meaning the form data will be submitted to the same script.
- The `method="post"` attribute specifies that the form data will be sent via the POST method.
- The PHP script at the top of `form.php` processes the form data. It checks if the form has been submitted using `$_SERVER["REQUEST_METHOD"] == "POST"`.
- The `$_POST` superglobal collects the data entered into the form. `$_POST['name']` and `$_POST['email']` capture the data from the input fields.
- `htmlspecialchars` prevents security vulnerabilities like cross-site scripting (XSS) by converting special characters to HTML entities.
- The script checks if the name and email fields are filled out. If they are, it echoes a greeting and the email address; if not, it prints an error message.

This example demonstrates creating a simple HTML form and processing its data with PHP. It's a common pattern in web development for user data collection and handling.

## Working with Password Hashing

**Create a Password Hash**
   ```php
    $hash = password_hash("password", PASSWORD_DEFAULT);
   ```

**Verify Hashed Password**
   ```php
    if (password_verify('password', $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
   ```

## Working with Sessions

PHP sessions are a way to store information (in variables) to be used across multiple pages. Unlike cookies, session data is stored on the server. Sessions retain user information across different pages for a single visit (session).

Here's a basic example of creating and working with PHP sessions:

### Starting a Session

First, you must start a session on each page to access session variables. This is typically done at the very beginning of your PHP script.

```php
 session_start();
```

**Setting Session Variables**

Once a session is started, you can set session variables. Here's how you can set a few variables:

```php
 session_start();
 
 // Set session variables
 $_SESSION["username"] = "JohnDoe";
 $_SESSION["email"] = "johndoe@example.com";
 $_SESSION["loggedIn"] = true;
```

### Accessing Session Variables on Another Page

To access session variables on another page, start the session on that page and then access the variables:

**Page 2:**

```php
 session_start();
 
 // Access session variables
 echo "Welcome " . $_SESSION["username"] . "<br>";
 echo "Your email is " . $_SESSION["email"];
```

**Destroying a Session**

When you want to end a session and clear all session data, use `session_destroy()`. It's a good practice to unset the session variables first using `session_unset()`:

```php
 session_start();
 
 // Unset all session variables
 session_unset();
 
 // Destroy the session
 session_destroy();
```

**Session Notes**

- `session_start()` must be your document's first thing. Before any HTML tags.
- Sessions are ideal for sensitive data like user login information, as they are stored on the server.
- The session data will remain available as long as the browser is open and the session hasn't been explicitly destroyed.

This example demonstrates a basic usage of PHP sessions. Sessions are widely used for maintaining user state and data across page loads, making them essential for user authentication systems and any application that requires data to persist across multiple pages.

## Working with Cookies

Cookies in PHP are small pieces of data stored on the client's computer. They are typically used to remember information about the user for the duration of their visit or repeat visits. Here's a basic example of creating and working with cookies in PHP:

**Setting a Cookie**

To set a cookie in PHP, you use the `setcookie()` function. This function must be called before any output is sent to the browser (similar to `session_start()`).

```php
 // Setting a cookie that expires in 30 days
 $cookie_name = "user";
 $cookie_value = "John Doe";
 setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
 
 // Note: If this script has any HTML before it, the setcookie() function call will fail.
```

**Accessing a Cookie**

You can access cookies in PHP using the `$_COOKIE` superglobal array. Remember that a cookie will not be available until the next page loading on which the cookie is set.

```php
 // Check if the cookie is set
 if(!isset($_COOKIE["user"])) {
     echo "Cookie named 'user' is not set!";
 } else {
     echo "Cookie 'user' is set!<br>";
     echo "Value is: " . $_COOKIE["user"];
 }
```

**Modifying a Cookie**

To modify a cookie, just set the cookie again using the `setcookie()` function with the new value.

```php
 // Modifying the cookie value
 $cookie_value = "Jane Doe";
 setcookie("user", $cookie_value, time() + (86400 * 30), "/");
```

**Deleting a Cookie**

To delete a cookie, use the `setcookie()` function with an expiration date in the past.

```php
 // Deleting a cookie
 setcookie("user", "", time() - 3600, "/");
```

**Cookie Crumbs (Notes)**

- The `setcookie()` function must be called before any output is sent to the browser.
- Cookies are part of the HTTP header, so `setcookie()` must be called before HTML tags.
- The value of the cookie is stored on the client's machine and can be manipulated by the client, so do not store sensitive information in cookies.
- Cookies might not be immediately available after they are set because the client needs to send them back to the server with the following HTTP request.

These examples cover the basic operations you can perform with cookies in PHP - setting, accessing, modifying, and deleting them. Cookies are fundamental to web development for storing user preferences, tracking user sessions, and managing user data across different website pages.

## Working with JSON Data

Working with JSON (JavaScript Object Notation) data in PHP is quite common, especially in web development for APIs, configurations, and data exchange between a server and a client. JSON is a lightweight data-interchange format that is easy for humans to read and write and for machines to parse and generate.

Here's a basic example of creating and working with JSON data in PHP:

**Creating JSON Data**

First, we'll create an associative array in PHP and then convert it to JSON.

```php
 // Creating an associative array
 $user = array(
     "name" => "John Doe",
     "email" => "johndoe@example.com",
     "age" => 30
 );
 
 // Converting the array to a JSON string
 $jsonString = json_encode($user);
 
 echo $jsonString;
```

This script will output something like:

```json
 {"name":"John Doe","email":"johndoe@example.com","age":30}
```

**Decoding JSON Data**

Next, let's take a JSON string and convert it into a PHP array:

```php
 // A JSON string
 $jsonString = '{"name":"Jane Doe","email":"janedoe@example.com","age":25}';
 
 // Decoding the JSON string into a PHP array
 $userArray = json_decode($jsonString, true);
 
 // Accessing elements of the array
 echo "Name: " . $userArray['name'] . "<br>";
 echo "Email: " . $userArray['email'] . "<br>";
 echo "Age: " . $userArray['age'];
```

This script will output the following:

```
 Name: Jane Doe
 Email: janedoe@example.com
 Age: 25
```

**JSON Notes:**

- `json_encode()` encodes a PHP array (or object) into a JSON string.
- `json_decode()` decodes a JSON string into a PHP array. By setting the second parameter to `true`, the function will return an associative array; otherwise, it returns an object.
- JSON is a standard format widely used for web applications, APIs, and configurations.

These examples demonstrate converting between PHP arrays and JSON strings, a common requirement in modern web development and data handling.
