# Public Api Education System laravel project

## Structure

Studen

Classroom

Lecture

## Api

### Student

<details>
 <summary><code>GET</code> <code><b>/api/v1/students</b></code></summary>

##### Parameters

> None

##### Responses

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `[{"name": "...", "created":"DD-MM-YYYY"}, ... {}]`                                                  |
> | `400`         | `application/json`                | `{"code":"400","message":"Bad Request"}`                            |

##### Example cURL

> ```javascript
>  curl -X GET -H "Content-Type: application/json" http://localhost:8000/api/v1/students
> ```

</details>