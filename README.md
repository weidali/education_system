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


##### Example cURL

> ```javascript
>  curl -X GET -H "Content-Type: application/json" http://localhost:8000/api/v1/students
> ```

</details>

<details>
 <summary><code>GET</code> <code><b>/api/v1/students/{student}</b></code></summary>

##### Path Variables

> | key       |  type     | data type       | description                          |
> |-----------|-----------|-----------------|--------------------------------------|
> | student   |  required | int             | The specific student numeric id      |

##### Responses

> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"name": "...", "created":"DD-MM-YYYY"}`                                                  |
> | `404`         | `application/json`                | `{"code":"404","message":"Not found"}`                            |

##### Example cURL

> ```javascript
>  curl -X GET -H "Content-Type: application/json" http://localhost:8000/api/v1/students
> ```

</details>
