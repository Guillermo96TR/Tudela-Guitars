import { useContext, useState } from "react";
import { useNavigate} from "react-router-dom";
import { AuthContext } from "../../components/AuthContext";
import "../Contacto/Contact.css"
const Contact = () => {
  const navigate = useNavigate();
  const { token, setToken } = useContext(AuthContext);
  const [formValues, setFormValues] = useState({
    nombre: "",
    mensaje: "",
    email: "",
  });
  const handleInputChange = (e) => {
    setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    fetch("http://127.0.0.1:8080/contacto/new", {
      method: "POST",
      body: JSON.stringify(formValues),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        setToken(data.token);
        navigate("/enviado", { replace: true });
      });
  };

  return (
    <>
      <h1>Formulario de contacto</h1>
      <div className="contactform">
        <form onSubmit={handleSubmit}>
          <label htmlFor="email">Email:</label>
          <input
           required={true}
            id="email"
            name="email"
            type="email"
            onChange={handleInputChange}
            value={formValues.email}
          />
          <label htmlFor="nombre">Nombre:</label>
          <input
          required={true}
            id="nombre"
            name="nombre"
            type="text"
            onChange={handleInputChange}
            value={formValues.nombre}
          />
          <label htmlFor="mensaje">Mensaje:</label>
          <textarea
           required={true}
            id="mensaje"
            name="mensaje"
            type="text"
            onChange={handleInputChange}
            placeholder="Deja aquí tu mensaje y lo responderemos con la mayor brevedad posible"
          ></textarea>
          <button type="submit">Enviar</button>
        </form>
      </div>
    </>
  );
};
export default Contact;
