# fixtures
auto generate fixtures, i didn't havve the time to fill a database so juste fixtures
You may encounter a problem saying 

```
[TypeError]                                                        
  join(): Argument #2 ($array) must be of type ?array, string given
```

so just replace code like: 

```
join($var, ' ');
```

TO 

```
join(' ', $var);
```