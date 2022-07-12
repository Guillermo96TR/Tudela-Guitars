import { useState } from "react";
import swal from "sweetalert";
import styles from "./Register.module.css"
import { useNavigate } from "react-router-dom";
export function NewGuitar() {
    const navigate = useNavigate();
    const [formValues, setFormValues] = useState({
        // Guardamos información del formulario
        nombre: "",
        caracteristicas: "",
        precio: "",
        imagen: ""
    });
    const handleInputChange = (e) => {
        // Metemos información del formulario en la variable formValues
        setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
    };
    const handleSubmit = (e) => {
        e.preventDefault();
        //Funcion para el submit, evitamos la funcion por defecto y le decimos que 
        // Coja la información recibida por formulario.
        let formData = new FormData();
        formData.append("nombre", formValues.nombre);
        formData.append("caracteristicas", formValues.caracteristicas);
        formData.append("precio", formValues.precio);
        formData.append("imagen", e.target.imagen.files[0]);


        // Fetch para crear nueva publicación. Si el usuario no está logeado, no podrá.
        // Para ello hacemos la verificación del token en: Authorization.
        fetch("http://localhost:8080/guitars/new", {
            method: "POST",
            body: formData,
            headers: {
                enctype: "multipart/form-data",
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        })
            .then((res) => res.json())
            .then((data) => {
                swal("Post created correctly");
                navigate("/userguitars", { replace: true })
            });

    };
    return (
        <div className={styles.reg}>
            <form className={styles.contactform} onSubmit={handleSubmit}>
                <label className={styles.labels} htmlFor="nombre">
                    Nombre
                </label>
                <input
                    className={styles.user}
                    required={true}
                    id="nombre"
                    name="nombre"
                    type="text"
                    onChange={handleInputChange}
                    value={formValues.nombre}
                />
                <label className={styles.labels} htmlFor="caracteristicas">
                   Caracteristicas
                </label>
                <textarea
                    className={styles.password}
                    required={true}
                    id="caracteristicas"
                    name="caracteristicas"
                    type="text"
                    onChange={handleInputChange}
                    values={formValues.caracteristicas}
                />
                <label className={styles.labels} htmlFor="precio">
                Precio
                </label>
                <textarea
                    className={styles.password}
                    required={true}
                    id="precio"
                    name="precio"
                    type="number"
                    onChange={handleInputChange}
                    values={formValues.precio}
                />
                <label className={styles.labels} htmlFor="imagen">
                    Imagen
                </label>
                <input
                    className={styles.password}
                    id="imagen"
                    name="imagen"
                    type="file"
                    accept="image/*"
                    onChange={handleInputChange}
                />

                <button className={styles.boton} type="submit">
                    Crear
                </button>
            </form>
        </div>
    )
}