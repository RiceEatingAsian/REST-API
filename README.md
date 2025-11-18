# REST-API
Creates a simple read-only API endpoint. Sets the Content-Type: application/json header, fetches data from the posts and users tables, and converts the resulting PHP array into a JSON string using json_encode() for consumption by external applications.


### 10. Simple REST API Endpoint (JSON Output)

This final experiment converts a standard database query into a basic web service endpoint, demonstrating how to serve data in the widely used JSON format.

| File | Description |
| :--- | :--- |
| `api_posts.php` | Fetches data from the `posts` table and returns it as a machine-readable format. It ensures the correct **HTTP header** (`Content-Type: application/json`) is set. The data is prepared in a PHP array and then output using the native **`json_encode()`** function. |
