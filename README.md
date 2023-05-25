# Public Api Education System laravel project

## Installation

```bash
git clone git@github.com:weidali/education_system.git
cd education_system
cp .env.example .env
touch database/database.sql
composer install --optimize-autoloader --no-dev
```

Get into the project root, open `.env` file and update configuration details (e.g. db connection settings)

Start testing:
```bash
php artisan test
```

Start server:
```bash
php artisan serve
```

## Structure

- Student
  - name
  - email

- Classroom
  - title

- Lecture
  - theme
  - description

## Api

### Student
<details>
 <summary><code>GET</code> <code><b>/api/v1/students</b></code></summary>

##### Parameters

> None

##### Responses
> | http code     | content-type                | response                                                            |
> |---------------|-----------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`          | `[{"name": "...", "created":"DD-MM-YYYY"}, ... {}]`                 |


##### Example cURL
> ```bash
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
> ```bash
>  curl -X GET -H "Content-Type: application/json" http://localhost:8000/api/v1/students/{id}
> ```

</details>

<details>
 <summary><code>POST</code> <code><b>/api/v1/students</b></code></summary>

##### Parameters

> | key       |  type     | data type       | description                          |
> |-----------|-----------|-----------------|--------------------------------------|
> | name   |  required | string, max:50             | The specific student string name      |
> | email   |  required | string, email, unique, max:100            | The specific student string email      |
> | classroom_id   |  nullable | int, exists:classroom,id            | The specific classroom numeric id      |

##### Responses
> | http code     | content-type                | response                                                            |
> |---------------|-----------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`          | `[{"name": "...", "created":"DD-MM-YYYY"}, ... {}]`                 |
> | `422`         | `application/json`          | `{"error": "...", `                 |

</details>

<details>
 <summary><code>DELETE</code> <code><b>/api/v1/students/{student}</b></code></summary>

##### Path Variables
> | key       |  type     | data type       | description                          |
> |-----------|-----------|-----------------|--------------------------------------|
> | student   |  required | int             | The specific student numeric id      |

##### Responses
> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `204`         | `application/json`                | `null`                                                              |
> | `404`         | `application/json`                | `{"code":"404","message":"Not found"}`                              |

##### Example cURL
> ```bash
>  curl -X DELETE -H "Content-Type: application/json" http://localhost:8000/api/v1/students/{id}
> ```

</details>

### Classroom
<details>
 <summary><code>GET</code> <code><b>/api/v1/classrooms</b></code></summary>

##### Parameters

> None

##### Responses
> | http code     | content-type                | response                                                            |
> |---------------|-----------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`          | `[{"title": "...", "created":"DD-MM-YYYY"}, ... {}]`                 |


##### Example cURL
> ```bash
>  curl -X GET -H "Content-Type: application/json" http://localhost:8000/api/v1/classrooms
> ```

</details>

<details>
 <summary><code>GET</code> <code><b>/api/v1/classrooms/{classroom}</b></code></summary>

##### Path Variables
> | key       |  type     | data type       | description                          |
> |-----------|-----------|-----------------|--------------------------------------|
> | classroom   |  required | int             | The specific classroom numeric id      |

##### Responses
> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`                | `{"title": "...", "created":"DD-MM-YYYY"}`                                                  |
> | `404`         | `application/json`                | `{"code":"404","message":"Not found"}`                            |

##### Example cURL
> ```bash
>  curl -X GET -H "Content-Type: application/json" http://localhost:8000/api/v1/classrooms/{id}
> ```

</details>

<details>
 <summary><code>POST</code> <code><b>/api/v1/classrooms</b></code></summary>

##### Parameters

> | key       |  type     | data type       | description                          |
> |-----------|-----------|-----------------|--------------------------------------|
> | title   |  required | string, unique, max:100            | The specific classroom string title      |

##### Responses
> | http code     | content-type                | response                                                            |
> |---------------|-----------------------------|---------------------------------------------------------------------|
> | `200`         | `application/json`          | `[{"title": "...", "created":"DD-MM-YYYY"}, ... {}]`                 |
> | `422`         | `application/json`          | `{"error": "...", `                 |

</details>

<details>
 <summary><code>DELETE</code> <code><b>/api/v1/classrooms/{classroom}</b></code></summary>

##### Path Variables
> | key       |  type     | data type       | description                          |
> |-----------|-----------|-----------------|--------------------------------------|
> | student   |  required | int             | The specific student numeric id      |

##### Responses
> | http code     | content-type                      | response                                                            |
> |---------------|-----------------------------------|---------------------------------------------------------------------|
> | `204`         | `application/json`                | `null`                                                              |
> | `404`         | `application/json`                | `{"code":"404","message":"Not found"}`                              |

##### Example cURL
> ```bash
>  curl -X DELETE -H "Content-Type: application/json" http://localhost:8000/api/v1/students/{id}
> ```

</details>



## Coding style guidelines

When developing, we follow the guide from the "[Laravel & PHP 'Spatie'][spatie/guidelines]" article.