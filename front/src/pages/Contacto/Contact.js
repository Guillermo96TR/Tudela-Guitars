import { useState } from "react";
import { useNavigate} from "react-router-dom";
import styles from "../Contacto/Contact.module.css"
import swal from "sweetalert";
const Contact = () => {
  const navigate = useNavigate();
  // Guardamos la información del formulario en formValues.
  const [formValues, setFormValues] = useState({
    nombre: "",
    mensaje: "",
    email: "",
  });
// función para guardar la información en el formulario.
  const handleInputChange = (e) => {
    setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = (e) => {
    //Evitamos con preventDefault que el formulario haga cosas por defecto y hacemos el Fetch.
    e.preventDefault();
    fetch("http://127.0.0.1:8080/api/contacto/new", {
      method: "POST",
      body: JSON.stringify(formValues),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((res) => res.json())
      .then((data) => {
                swal("Mensaje enviado!");
                window.location.reload();
              });
  };
  return (
    <>
      <div className={styles.default}>
      <h1>Formulario de contacto</h1>
        <form className={styles.contactform} onSubmit={handleSubmit}>
        <label className={styles.labels} htmlFor="nombre">Nombre:</label>
          <input className={styles.usuario}
          required={true}
            id="nombre"
            name="nombre"
            type="text"
            onChange={handleInputChange}
            value={formValues.nombre}
            placeholder="Escribe tu nombre"
          />
          <label className={styles.labels} htmlFor="email">Email:</label>
          <input className={styles.usuario}
          required={true}
            id="email"
            name="email"
            type="email"
            onChange={handleInputChange}
            value={formValues.email}
            placeholder="Escribe tu email"
          />
          <label className={styles.labels} htmlFor="mensaje">Mensaje:</label>
          <textarea className={styles.usuario}
           required={true}
            id="mensaje"
            name="mensaje"
            type="text"
            onChange={handleInputChange}
            placeholder="Escribe tu mensaje"
          ></textarea>
          <button className={styles.boton}type="submit">Enviar</button>
        </form>
      </div>
    </>
    
  );
};
export default Contact;
