import { useState, useEffect } from "react";
import styles from "./Contact.module.css"
import swal from 'sweetalert';
import {useParams } from "react-router-dom";
import { useNavigate } from "react-router";
const EditBassGuitars = () => {
    const navigate = useNavigate();
  const params = useParams("");
  // Guardamos información del formulario
  const [formValues, setFormValues] = useState({
    nombre: "",
    caracteristicas: "",
    precio: "",
    imagen:""
  });

  const handleInputChange = (e) => {
    // Metemos información del formulario en la variable formValues
    setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  //Funcion para el submit, evitamos la funcion por defecto y le decimos que 
  // Coja la información recibida por formulario.
    const handleSubmit = (e) => {
    e.preventDefault();
    let formData = new FormData();
    formData.append("nombre", formValues.nombre);
    formData.append("caracteristicas", formValues.caracteristicas);
    formData.append("precio", formValues.precio);
    formData.append("imagen", e.target.imagen.files[0]);

// Hacemos fetch para introducir la nueva información en la publicación.

    fetch(`http://localhost:8080/bass/guitar/${params.id}/edit`, {
      method: "POST",
      body: formData,
      headers: {
        enctype: "multipart/form-data",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        swal("Post edited successfully");
        if(data.code===500){
          swal("Image size too high")
        } else{
          navigate("/userproducts", { replace: true })
        }
    });
}

  useEffect(() => {
        //Hacemos fetch para ver que publicación vamos a editar.

    fetch(`http://localhost:8080/bass/guitar/${params.id}`, {
        method: "GET",
        headers: {
          Authorization : 'Bearer ' + localStorage.getItem('token')
        }
      })
        .then((res) => res.json())
        .then((data) => {
          setFormValues((prev) => ({
            // Obtenemos información actual de la publicación.
            ...prev,
            nombre: data.result.nombre,
            caracteristicas: data.result.caracteristicas,
            precio: data.result.precio,
            imagen: data.result.imagen
          }));
        })
        
        .catch((error) => console.log(error));
  }, []);

  return (
    <>
      <h1>Edit guitar information</h1>
      <div className={styles.default}>
        <form className={styles.contactform} onSubmit={handleSubmit}>
                  <label className={styles.labels} htmlFor="nombre">Nombre:</label>
          <input className={styles.usuario}
         id="nombre"
            name="nombre"
            type="text"
            onChange={handleInputChange}
            defaultValue={formValues.nombre}
          />
          <label className={styles.labels} htmlFor="caracteristicas">Caracteristicas:</label>
          <textarea className={styles.comentario}
            id="caracteristicas"
            name="caracteristicas"
            type="text"
            onChange={handleInputChange}
            defaultValue={formValues.caracteristicas}
          />
           <label className={styles.labels} htmlFor="precio">Precio:</label>
          <textarea className={styles.usuario}
            id="precio"
            name="precio"
            type="number"
            onChange={handleInputChange}
            defaultValue={formValues.precio}
          />
          <label className={styles.labels} htmlFor="image">Imagen:</label>
          <input className={styles.usuario}
            id="imagen"
            name="imagen"
            type="file"
            accept="image/*"
            onChange={handleInputChange}
          />
          <button className={styles.boton}type="submit">Send</button>
        </form>
      </div>
    </>
    
  );
};
export default  EditBassGuitars;
