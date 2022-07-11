import { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { AuthContext } from "../../components/AuthContext";
import { Link } from "react-router-dom";
import styles from "../Login/Login.module.css";
import swal from "sweetalert";

const Login = () => {
  const navigate = useNavigate();
  const { token, setToken } = useContext(AuthContext);
  const [formValues, setFormValues] = useState({ username: "", password: "" });
  const handleInputChange = (e) => {
    setFormValues((prev) => ({ ...prev, [e.target.name]: e.target.value }));
  };
  const handleSubmit = (e) => {
    e.preventDefault();
    fetch("http://127.0.0.1:8080/api/login_check", {
      method: "POST",
      body: JSON.stringify(formValues),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.code === 401) {
          swal("User or password wrong");
        } else {
          localStorage.setItem("token", data.token);
          navigate("/dashboard", { replace: true });
          {
            window.location.reload();
          }
        }
      })
  };

  // if (!token) return <Navigate to="/register"replace />;

  return (
    <>
      <h1>Formulario de Login</h1>
      <div className={styles.login}>
        <form className={styles.contactform} onSubmit={handleSubmit}>
          <label className={styles.labels} htmlFor="username">
            Username
          </label>
          <input
            className={styles.user}
            required={true}
            id="username"
            name="username"
            type="text"
            onChange={handleInputChange}
            value={formValues.username}
            placeholder=""
          />
          <label className={styles.labels} htmlFor="password">
            Contraseña
          </label>
          <input
            className={styles.password}
            required={true}
            id="password"
            name="password"
            type="password"
            onChange={handleInputChange}
            values={formValues.password}
            placeholder=""
          />
          <button className={styles.boton} type="submit">
            Iniciar sesión
          </button>
          <div className={styles.links}>
            <Link to="/register">Crea una cuenta</Link>
          </div>
        </form>
      </div>
    </>
  );
};
export default Login;
