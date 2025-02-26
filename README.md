Dependency Injection Example
----------------------------

This is an example of how to use dependency injection in PHP.

The `ThemeReader` class is injected with a `Worksheet` object. The original design of the class passed in a file path and constructed the `Worksheet` object internally.

In this case, the only way to test the variability of the reader would be to create multiple xlsx files with different data, mock the `Worksheet` object, or create a single test xlsx file that handles all cases. Each of these options has drawbacks and isn't very maintainable.

Multiple files is a pain to maintain as the cases grow, Mocking can diverge from the actual implementation and creating a single test xlsx file that handles all cases will mix a lot of different cases together.

By injecting the `Worksheet`, we can now build a few rows in memory that represent our individual test cases.

As a plus, it is easy to define edge cases and ensure that if the xlsx file ever diverges from a given contract, it will fail the tests.
