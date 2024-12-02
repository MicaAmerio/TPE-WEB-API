# TPE-WEB-API
-integrante: Amerio Micaela
-Trabajo de productos de limpieza con categoria y ofertas.
-limpieza API
limpieza api es una api rest diseñada para que los usuarios puedan interactuar con la página de limpieza, pudiendo elegir entre sus producto,categorias y ofertas .Tambien puedan obtener información que ayude en la decisión de adquirir un nuevo producto. Esta documentación tiene como objetivo explicar paso a paso la implementación de la api, facilitando así su uso y entendimiento.
-La aplicacion comenzara a ejecutarse en http://localhost/TPE-WEB2-api/ 
-Los ítem de las tablas se ordenan de manera ascendente por defecto y por orden ascendente o descendente, a través de parámetro GET.

# La aplicacion define las siguientes Endpoints de la API.
.GET /ofertas
Para obtener todas las ofertas: Obtiene toda la colección de ofertas disponibles en la base de datos
-Codigo de respuesta 
.200 (Ok)
.404 (no existe oferta)

//trae todas las ofertas.
.POST /oferta
https://localhost/tpe-web2-api/api/ofertas
Para crear una nueva oferta .Crea una oferta obteniendo los datos del body con el formato
//Crea oferta
.200 (ok)
.404 (no se creo oferta)

.GET /ofertas/{id}
Me trae la oferta con ese id.
//trae las ofertas por id.
https://localhost/tpe-web2-api/api/oferta/:id
.200 (ok)
.404(no existe oferta con ese id)

.PUT/oferta
Para modificar una oferta. Modifica una oferta con el id especificado.
https://localhost/tpe-web2-api/api/oferta/:id
//Edita las oferta
.200 (ok)
.404 (no se pudo modificar oferta)

.GET 
Me trae todas las ofertas descentemente y por defecto por id.
https://localhost/tpe-web2-api/api/oferta/desc
.200 (ok)
.404 (no existen ofertas)

.GET
Trae las ofertas ordenadas por la columna que nombremos en el primer parametro(:columna) y descendentemente por el segundo parametro(:orden)
https://localhost/tpe-web2-api/api/ofertas/:columna/:orden
.200 (ok)
.404 (no existen las ofertas)
