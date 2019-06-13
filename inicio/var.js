var busqueda;
function myFunction() {
     busqueda = document.getElementById("txtbusqueda").value;
     alert(busqueda);
     window.location.href = "http://localhost/2019-1-qa-grupo3-master/inicio/busquedaPost.php?var=" + busqueda;
    }

function mostrar()
{
    alert(busqueda);
    document.getElementById("myInput").value = busqueda;
}