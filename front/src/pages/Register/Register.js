import { useContext, useState } from "react";
import { useNavigate, Navigate } from "react-router-dom";
import { AuthContext } from "../../components/AuthContext";
import styles from "./Register.module.css";
import swal from "sweetalert";
//Register function, gets token and formValues and check it
//after, then you will be redirected to Home if all ok.
const Register = () => {
  const { setToken } = useContext(AuthContext);
  const navigate = useNavigate();
  const [formValues, setFormValues] = useState({ username: "", password: "" });
  const handleInputChange = (e) => {
    setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };
  //Petition to server.
  const handleSubmit = (e) => {
    e.preventDefault();
    fetch("http://localhost:8080/user/new", {
      method: "POST",
      body: JSON.stringify(formValues),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        navigate("/login", { replace: true });
        swal("You can sig in now!");
      });
  };
  //When you click Register, it doesn't do anything but
  // If you go to DB you will se there's the new user,
  // didnt have time for more, sorry.
  return (
    <>
      <h1>Regístrese aquí</h1>
      <div className={styles.reg}>
        <form className={styles.contactform} onSubmit={handleSubmit}>
          <label className={styles.labels} htmlFor="username">
            Nombre de usuario
          </label>
          <input
            className={styles.user}
            placeholder="Escriba aquí su nombre de usuario"
            required={true}
            id="username"
            name="username"
            type="text"
            onChange={handleInputChange}
            value={formValues.username}
          />
          <label className={styles.labels} htmlFor="password">
            Contraseña
          </label>
          <input
            className={styles.password}
            placeholder="Escriba aquí su contraseña"
            required={true}
            id="password"
            name="password"
            type="password"
            onChange={handleInputChange}
            values={formValues.password}
          />
          <button className={styles.boton} type="submit">
            {" "}
            Crear cuenta
          </button>
        </form>
      </div>
    </>
  );
};
export default Register;
