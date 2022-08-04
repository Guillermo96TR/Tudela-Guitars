import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import {  useNavigate } from "react-router";
import "./Publicaciones.css";

export function UserGuitars() {
  const [user, setUser] = useState();
  const navigate = useNavigate();
  useEffect(() => {
    //Fetch para ver el usuario actual, obtenemos el token y así la información del usuario.

    fetch("http://localhost:8080/api/usuario/get", {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    })
      .then((res) => res.json())
      .then((data) => {
          console.log(data.result);
          setUser(data.result);
        }
      );
  }, []);

  return (
    // si hay usuario, pintamos publicaciones de ese usuario.
    <>
      {user ? ( 
        <div className="usuarioguitarras">
          <h2>Tus guitarras, {user.nombre}</h2>
        <section className="seccion">
          {user.guitars.map((guitar) => (
            <div className="publicaciones" key={guitar.id}>
              <div className="titulo1">{guitar.nombre}</div>
              <div className="imagenes">
                <Link className="linkpu" to={`/guitars/${guitar.id}`}>
                <img src={guitar.imagen} />
                </Link>
              </div>
              <div className="seccion">
                    {/*  Botón para EDITAR publicacion.*/}
              <button className="button1"onClick={()=>{
                navigate(`/edituserguitars/${guitar.id}`, { replace: true })
              }} > Editar</button>
                <div>

                  {/*  Botón para BORRAR publicacion.*/}

              <button className="button1"
              onClick={() => {

               {/* Le mandamos una alerta al usuario de si está seguro.*/}

              if (window.confirm("Are you sure?") ) {fetch(
              `http://localhost:8080/guitars/delete/${guitar.id}`,{
                method: "DELETE",
                headers: {
                  "Content-Type": "application/json",
                  "Authorization": 'Bearer '+ localStorage.getItem('token')
                },
                 }
                  )
                 .then((res) => res.json())
                 .then((data) => {
                 if (data.result === "ok") {
                 window.location.reload();}})}}}> 
                 Borrar</button>

                     {/*  Botón para ir atrás.*/}
                 <button className="button1"onClick={()=>{
                navigate("/dashboard", { replace: true })
              }} > Atras</button>
                  {/*  Botón para CREAR publicacion.*/}
                   <button className="button1"onClick={()=>{
                navigate("/newguitar", { replace: true })
              }} > Crear</button>
              </div>
              </div>
                     
            </div>
          ))}
        </section>
      </div>
      ) : (
        <div>
          Loading...
        </div>
      )}
      {user ? ( 
        <div>
          <h2>Tus bajos, {user.nombre}</h2>
        <section className="seccion">
          {user.bassguitars.map((bass) => (
            <div className="publicaciones" key={bass.id}>
              <div className="titulo1">{bass.nombre}</div>
              <div className="imagenes">
                <Link className="linkpu" to={`/bassguitars/${bass.id}`}>
                <img src={bass.imagen} />
                </Link>
              </div>
              <div className="seccion">
                    {/*  Botón para EDITAR publicacion.*/}
              <button className="button1"onClick={()=>{
                navigate(`/edituserbassguitars/${bass.id}`, { replace: true })
              }} > Editar</button>
                <div>

                  {/*  Botón para BORRAR publicacion.*/}

              <button className="button1"
              onClick={() => {

               {/* Le mandamos una alerta al usuario de si está seguro.*/}

              if (window.confirm("Are you sure?") ) {fetch(
              `http://localhost:8080/bass/guitar/delete/${bass.id}`,{
                method: "DELETE",
                headers: {
                  "Content-Type": "application/json",
                  "Authorization": 'Bearer '+ localStorage.getItem('token')
                },
                 }
                  )
                 .then((res) => res.json())
                 .then((data) => {
                 if (data.result === "ok") {
                 window.location.reload();}})}}}> 
                 Borrar</button>

                     {/*  Botón para ir atrás.*/}
                 <button className="button1"onClick={()=>{
                navigate("/dashboard", { replace: true })
              }} > Atras</button>
                  {/*  Botón para CREAR publicacion.*/}
                   <button className="button1"onClick={()=>{
                navigate("/newbassguitar", { replace: true })
              }} > Crear</button>
              </div>
              </div>
                     
            </div>
          ))}
        </section>
      </div>
      ) : (
        <div>
          Loading...
        </div>
      )}
      
    </>
  );
}
