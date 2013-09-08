izarusRegionesProvinciasComunasChilePlugin
==========================================

Plugin Symfony 1.4 para tener las regiones, provincias y comunas de Chile, con módulos admin.

Utilización
-----------

1. Habilitar el plugin en `config/ProjectConfiguration.class.php`:
```
  public function setup()
  {
    $this->enablePlugins(
      [...],
      'izarusRegionesProvinciasComunasChilePlugin'
    );
    [...]
  }
```



2. Habilitar los módulos CRUD en una aplicación `apps/APPNAME/config/settings.yml`:

````
all:
  .settings:
    enabled_modules:  [ default, [...], comunas, provincias, regiones ]
````

3. Reconstruir el modelo y cargar los datos

```
$ php symfony doctrine:build --all --and-load
```

